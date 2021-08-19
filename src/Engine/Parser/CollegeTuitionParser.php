<?php

namespace App\Engine\Parser;

use App\Engine\Entity\CollegeTuitionItem;
use NumberFormatter;
use Symfony\Component\DomCrawler\Crawler;

class CollegeTuitionParser extends AbstractParser
{

    private Crawler $crawler;

    private CollegeTuitionItem $item;

    private NumberFormatter $numberFormatter;

    public function parse(string $url, string $content): ?CollegeTuitionItem
    {
        $this->crawler = new Crawler($content, $url);
        $this->item = new CollegeTuitionItem();
        $this->numberFormatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);

        $this->parseDates();
        $this->parseRequiredForms();
        $this->parseFinancialAidStatistics();
        $this->parseExpensesPerAcademicYear();
        $this->parseAvailableAid();

        return $this->item;
    }


    private function parseDates(): void
    {
        $datesDom = $this->crawler->filter('#tut-dts > div.col-sm-9 > div');
        if ($datesDom->count()) {
            $this->item->setDates(self::trimText($datesDom->text(null, false)));

            $applicationDeadlinesDom = $datesDom->filter('div:nth-child(1) > div.number-callout');
            if ($applicationDeadlinesDom->count()) {
                $this->item->setApplicationDeadlines($applicationDeadlinesDom->text());
            }

            $notificationDateDom = $datesDom->filter('div:nth-child(2) > div.number-callout');
            if ($notificationDateDom->count()) {
                $this->item->setNotificationDate($notificationDateDom->text());
            }
        }
    }

    private function parseRequiredForms(): void
    {
        $requiredFormsDom = $this->crawler->filter('#tut-frm > div.col-sm-9 > div');
        if ($requiredFormsDom->count()) {
            $this->item->setRequiredForms(self::trimText($requiredFormsDom->text(null, false)));
        }
    }

    private function parseFinancialAidStatistics(): bool
    {
//        $curr = 'USD';

        $financialAidStatisticsDom = $this->crawler->filter('#tut-sts > div.col-sm-9');
        if (!$financialAidStatisticsDom->count()) {
            return false;
        }
        $this->item->setFinancialAidStatistics(self::trimText($financialAidStatisticsDom->text(null, false)));

        $averageFreshmanTotalNeedBasedGiftAidDom = $financialAidStatisticsDom->filter('div:nth-child(1) > div.col-xs-5.col-sm-5.text-right > div');
        if ($averageFreshmanTotalNeedBasedGiftAidDom->count()) {
            $this->item->setAverageFreshmanTotalNeedBasedGiftAid(
                $this->numberFormatter->parseCurrency($averageFreshmanTotalNeedBasedGiftAidDom->text(), $curr)
            );
        }

        $averageUndergraduateTotalNeedBasedGiftAidDom = $financialAidStatisticsDom->filter('div:nth-child(3) > div.col-xs-5.col-sm-5.text-right > div');
        if ($averageUndergraduateTotalNeedBasedGiftAidDom->count()) {
            $this->item->setAverageUndergraduateTotalNeedBasedGiftAid(
                $this->numberFormatter->parseCurrency($averageUndergraduateTotalNeedBasedGiftAidDom->text(), $curr)
            );
        }

        $averageNeedBasedLoanDom = $financialAidStatisticsDom->filter('div:nth-child(5) > div.col-xs-5.col-sm-5.text-right > div');
        if ($averageNeedBasedLoanDom->count()) {
            $this->item->setAverageNeedBasedLoan(
                $this->numberFormatter->parseCurrency($averageNeedBasedLoanDom->text(), $curr)
            );
        }

        $undergraduatesWhoHaveBorrowedThroughAnyLoanProgramDom = $financialAidStatisticsDom->filter('div:nth-child(7) > div.col-xs-5.col-sm-5.text-right > div');
        if ($undergraduatesWhoHaveBorrowedThroughAnyLoanProgramDom->count()) {
            $this->item->setUndergraduatesWhoHaveBorrowedThroughAnyLoanProgram(
                (int)$undergraduatesWhoHaveBorrowedThroughAnyLoanProgramDom->text()
            );
        }

        $averageAmountOfLoanDebtPerGraduateDom = $financialAidStatisticsDom->filter('div:nth-child(9) > div.col-xs-5.col-sm-5.text-right > div');
        if ($averageAmountOfLoanDebtPerGraduateDom->count()) {
            $this->item->setAverageAmountOfLoanDebtPerGraduate(
                $this->numberFormatter->parseCurrency($averageAmountOfLoanDebtPerGraduateDom->text(), $curr)
            );
        }

        $averageAmountOfEachFreshmanScholarshipGrantPackageDom = $financialAidStatisticsDom->filter('div:nth-child(11) > div.col-xs-5.col-sm-5.text-right > div');
        if ($averageAmountOfEachFreshmanScholarshipGrantPackageDom->count()) {
            $this->item->setAverageAmountOfEachFreshmanScholarshipGrantPackage(
                $this->numberFormatter->parseCurrency($averageAmountOfEachFreshmanScholarshipGrantPackageDom->text(), $curr)
            );
        }

        $financialAidProvidedToInternationalStudentsDom = $financialAidStatisticsDom->filter('div:nth-child(13) > div.col-xs-5.col-sm-5.text-right > div');
        if ($financialAidProvidedToInternationalStudentsDom->count()) {
            $this->item->setFinancialAidProvidedToInternationalStudents($financialAidProvidedToInternationalStudentsDom->text() == 'Yes');
        }

        return true;
    }

    private function parseExpensesPerAcademicYear(): bool
    {
        $expensesDom = $this->crawler->filter('#tut-xpn > div.col-sm-9');
        if (!$expensesDom->count()) {
            return false;
        }
        $this->item->setExpensesPerAcademicYear(self::trimText($expensesDom->text(null, false)));
        $items = $expensesDom->filter('div.row > div.col-sm-4');

        $array = $items->each(function ($node, $i) {
            /**
             * @var Crawler $node
             */
            $titleDom = $node->filter('div:nth-child(1)');
            if ($titleDom->count()) {
                $title = $titleDom->text();
            }
            $valueDom = $node->filter('div.number-callout');
            if ($valueDom->count()) {
                $value = $valueDom->text();
            }
            if (!isset($title, $value)) {
                return null;
            }
            return ['title' => $title, 'value' => $value];
        });

        foreach ($array as $expensesItem) {
            $this->parseExpensesPerAcademicYearItem($expensesItem);
        }
        return true;
    }


    private function parseExpensesPerAcademicYearItem(array $item): bool
    {

        if (empty($item)) {
            return false;
        }
        $title = $item['title'] ?? null;
        $value = $item['value'] ?? null;
        if (!isset($title, $value)) {
            return false;
        }
        switch ($title) {
            case 'Tuition':
                $this->item->setTuitionInState(
                    $this->numberFormatter->parseCurrency($value, $curr)
                );
                break;
            case 'Tuition (In-State)':
                $this->item->setTuitionInState(
                    $this->numberFormatter->parseCurrency($value, $curr)
                );
                break;
            case 'Tuition (Out-of-State)':
                $this->item->setTuitionOutOfState(
                    $this->numberFormatter->parseCurrency($value, $curr)
                );
                break;
            case 'Required Fees':
                $this->item->setRequiredFees(
                    $this->numberFormatter->parseCurrency($value, $curr)
                );
                break;
            case 'Average Cost for Books and Supplies':
                $this->item->setAverageCostForBooksAndSupplies(
                    $this->numberFormatter->parseCurrency($value, $curr)
                );
                break;
            case 'Tuition / Fees Vary by Year of Study':
                $this->item->setTuitionFeesVaryByYearOfStudy(
                    $value == 'Yes'
                );
                break;
            case 'Board for Commuters':
                $this->item->setBoardForCommuters(
                    $this->numberFormatter->parseCurrency($value, $curr)
                );
                break;
            case 'Transportation for Commuters':
                $this->item->setTransportationForCommuters(
                    $this->numberFormatter->parseCurrency($value, $curr)
                );
                break;
            case 'On-Campus Room and Board':
                $this->item->setOnCampusRoomAndBoard(
                    $this->numberFormatter->parseCurrency($value, $curr)
                );
                break;
            default:

                break;
        }
        return true;
    }

    private function parseAvailableAid(): bool
    {
        $availableAidDom = $this->crawler->filter('#tut-avl > div.col-sm-9');
        if (!$availableAidDom->count()) {
            return false;
        }
        $this->item->setAvailableAid(self::trimText($availableAidDom->text(null, false)));

        $financialAidMethodologyDom = $availableAidDom->filter('div:nth-child(1) > div:nth-child(2)');
        if ($financialAidMethodologyDom->count()) {
            $this->item->setFinancialAidMethodology($financialAidMethodologyDom->text());
        }

        $scholarshipsAndGrantsNeedBasedDom = $availableAidDom->filter('div:nth-child(3) > div:nth-child(2)');
        if ($scholarshipsAndGrantsNeedBasedDom->count()) {
            $this->item->setScholarshipsAndGrantsNeedBased(self::trimText($scholarshipsAndGrantsNeedBasedDom->text(null, false)));
        }

        $scholarshipsAndGrantsNonNeedBasedDom = $availableAidDom->filter('div:nth-child(5) > div:nth-child(2) > div');
        if ($scholarshipsAndGrantsNonNeedBasedDom->count()) {
            $this->item->setScholarshipsAndGrantsNonNeedBased(self::trimText($scholarshipsAndGrantsNonNeedBasedDom->text(null, false)));
        }

        $federalDirectStudentLoanProgramsDom = $availableAidDom->filter('div:nth-child(7) > div:nth-child(2)');
        if ($federalDirectStudentLoanProgramsDom->count()) {
            $this->item->setFederalDirectStudentLoanPrograms(self::trimText($federalDirectStudentLoanProgramsDom->text(null, false)));
        }

        $federalFamilyEducationLoanProgramsDom = $availableAidDom->filter('div:nth-child(9) > div:nth-child(2)');
        if ($federalFamilyEducationLoanProgramsDom->count()) {
            $this->item->setFederalFamilyEducationLoanPrograms(self::trimText($federalFamilyEducationLoanProgramsDom->text(null, false)));
        }

        $isInstitutionalEmploymentAvailableDom = $availableAidDom->filter('div:nth-child(11) > div:nth-child(2)');
        if ($isInstitutionalEmploymentAvailableDom->count()) {
            $this->item->setIsInstitutionalEmploymentAvailable(self::trimText($isInstitutionalEmploymentAvailableDom->text(null, false)));
        }

        $directLenderDom = $availableAidDom->filter('div:nth-child(13) > div:nth-child(2)');
        if ($directLenderDom->count()) {
            $this->item->setDirectLender($directLenderDom->text());
        }


        return true;
    }


}