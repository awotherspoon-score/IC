<?php
        /**
         * Helper Class For Forms
         *
         * Only works when pwd=admin root
         *
         **/

         //bring in the all important fckeditor
         include('inc/fckeditor/fckeditor.php');

         class FormHelper {
               private $monthArray = array();

               /**
                * Creates and returns an FCKEditor instance
                */
               public function getEditor($name, $toolbar = 'Basic', $width = null, $height = null) {
                  $editor = new FCKEditor($name);
                  $editor->BasePath = 'inc/fckeditor/';
                  $editor->Value = 'hello world';
                  $editor->ToolbarSet = $toolbar;
                  return $editor;
               }
               
               /**
                * Prints an FCKEditor
                *
                * Conveniant wrapper around getEditor()
                */
               public function printEditor($name, $toolbar = 'Basic', $width = null, $height = null) {
                    $this->getEditor($name, $toolbar, $width, $height)->Create();
               }

               public timestampFromCommandContext(CommandContext $context) {
                      return $this->timestampFromInputValues($context->get['date-day'], $context->get['date-month'], $context->get['date-year']); 
               }

               public timestampFromPost() {
                      return $this->timestampFromInputValues($_POST['date-day'], $_POST['date-month'], $_POST['date-year']);
               }

               public timestampFromInputValues($day, $month, $year) {
                      return mktime(0, 0, 0, $month, $day, $year);
               }

               /**
                * Gets a Complate Date Input String
                *
                * Gets concatenated select elements for day, month and year
                *
                * @param initial int (optional) timestamp of initial date
                * @param input string concatenated input elements string
                * TODO: Complete this method
                */
                public function getDateInput($initial = null) {
                        //set default to today if unset
                        $initial = ($initial == null) ? time() : $initial;

                        //get 'initial' arguments based on timestamp in initial
                        $day = (int) date('j', $initial); 
                        $month = (int) date('n', $initial);
                        $year = (int) date('Y', $initial);

                        //build the input
                        $input = $this->getDayInput($month, $day) 
                        . $this->getMonthArray($month) 
                        . $this->getYearInput($year);

                        return $input;

                } 

               /**
                * Gets an html day select element string
                *
                * @param $month int (1-12) reprenting month
                * @param $initial int (optional) represents initial value
                * @return $dayinput String html select element
                */
               public function getDayInput($month, $initial = 1) {
                        $months = $this->getMonthArray();
                        $month = $months[$month - 1]; //-1 because we need the 0-based index for the month array

                        $dayinput = "<select name='date-day' id='date-day'>\n";

                        for ($i = 1; $i <= $month['days']; $i++) {
                                $selected = ($i == $initial) ? ' selected' : '';
                                $dayinput .= "<option value='{$i}'{$selected}>$i</option\n";
                        }
                        $dayinput .= "</select>\n";
                        return $dayinput;
               }

               /**
                * Gets an html month select element string
                * 
                * @param $initial int (optional) (1-12) the currently selected month
                * @return $monthinput String html select element
                */
               public function getMonthInput($initial = 1) {
                        $months = $this->getMonthArray();
                        
                        $monthinput = "<select name='date-month' id='date-month'>\n";

                        foreach ( $months as $index => $month ) {
                               $shiftedIndex = $index + 1; //we need the 1-based index for our functions
                               $selected = ($initial == $shiftedIndex) ? ' selected' : ''; 
                               $monthinput .= "<option value='{$shiftedIndex}'{$select}>{$month['name']}</select>\n";
                        }
                                        
                        $monthinput .= "</select>";
                        return $monthinput;
               }

              /**
                * Gets an html year select element string
                *
                * @param $initial int (optional) currently selected year
                * @param $start int (optional) number of years in the past to display
                * @param $end int (optional) number of years in the future to display
                * @return $yearinput String html year select element
                */
              public function getYearInput($initial = null, $start = null, $end = null) {
                        //initialize args to defaults if unset
                        $initial = ($initial === null) ? (int) date('Y') : $initial; //default: this year
                        $start = ($start === null) ?  (date('Y') - 3) : $start;      //default: three years ago
                        $end = ($end === null) ? (date('Y') + 1) : $end;             //default: next year
                       
                        //build the year input string
                        $yearinput = "<select name='date-year' id='date-year'>\n";
                        for ($year = $start; $year <= $end; $year++) {
                                $selected = ($initial == $year) ? ' selected' : '';
                                $yearinput .= "<option value='{$year}'{$selected}>$year</option>\n";
                        }
                        $yearinput .= "</select>\n";
                        return $yearinput;
                }


               /**
                * array with days and names of months
                *
                * numbered 0-11, each element is an array
                * with keys 'days' and 'name'
                */
               public function getMonthArray() {
                       if (!isset($this->monthArray)) {
                      
                          $array = array(); 

                          $array[0]['name'] = 'January';
                          $array[0]['days'] = 31;                

                          $array[1]['name'] = 'February';
                          $array[1]['days'] = 28;

                          $array[2]['name'] = 'March';
                          $array[2]['days'] = 31;

                          $array[3]['name'] = 'April';
                          $array[3]['days'] = 30;

                          $array[4]['name'] = 'May';
                          $array[4]['days'] = 31;

                          $array[5]['name'] = 'June';
                          $array[5]['days'] = 30;

                          $array[6]['name'] = 'July';
                          $array[6]['days'] = 31;

                          $array[7]['name'] = 'August';
                          $array[7]['days'] = 31;

                          $array[8]['name'] = 'September';
                          $array[8]['days'] = 30;

                          $array[9]['name'] = 'Ocobter';
                          $array[9]['days'] = 31;

                          $array[10]['name'] = 'November';
                          $array[10]['days'] = 30;

                          $array[11]['name'] = 'December';
                          $array[11]['days'] = 31;

                          $this->monthArray = $array;
                      }

                      return $this->monthArray;
               }
         }
