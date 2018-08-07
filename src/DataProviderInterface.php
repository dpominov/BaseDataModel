<?php
/**
 * Author: Dmitrii Pominov ( DPominov@gmail.com )
 * Date: 28.12.17
 */

namespace BaseDataModel;


interface DataProviderInterface
{
    public static function instance();

    public function add(BaseDataModelInterface $entity);

    public function update(BaseDataModelInterface $entity, $id);

    public function get(BaseDataModelInterface $entity, $id);

    public function delete(BaseDataModelInterface $entity, $id);
}