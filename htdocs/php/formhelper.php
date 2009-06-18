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
               public getEditor($name, $toolbar = 'Basic', $width = null, $height = null) {
                  $editor = new FCKEditor($name);
                  $editor->BasePath = 'inc/fckeditor/';
                  $editor->Value = 'hello world';
                  $editor->ToolbarSet = $toolbar;
                  return $editor;
               }

               public printEditor($name, $toolbar = 'Basic', $width = null, $height = null) {
                    $this->getEditor($name, $toolbar, $width, $height)->Create();
               }

               public getDayInput($month) {
               }

               /**
                * array with days and names of months
                *
                * numbered 0-11, each element is an array
                * with keys 'days' and 'name'
                */
               public getMonthArray() {
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

                       return $array;

               }
         }
