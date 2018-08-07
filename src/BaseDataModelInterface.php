<?php
/**
 * Author: Dmitrii Pominov ( DPominov@gmail.com )
 * Date: 09.01.18
 */

namespace BaseDataModel;


interface BaseDataModelInterface
{
    public function getType();
    public function getData();
}