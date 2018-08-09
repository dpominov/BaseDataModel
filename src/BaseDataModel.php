<?php
/**
 * Author: Dmitrii Pominov ( DPominov@gmail.com )
 * Date: 28.12.17
 */

namespace BaseDataModel;

class BaseDataModel implements BaseDataModelInterface, \ArrayAccess
{
    /** @var DataProviderInterface */
    protected $dataProvider;
    protected $type;
    private $data;

    public $id = 0;


    public function __construct(DataProviderInterface $dataProvider, $id = 0)
    {
        $this->dataProvider = $dataProvider;

        $this->load($id);
    }


    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }


    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }


    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }


    public function offsetGet($offset)
    {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }


    public function getData()
    {
        return $this->data;
    }


    public function getType()
    {
        return $this->type;
    }


    public function load($id)
    {
        if (!$id) {
            return;
        }

        if (!$this->type) {
            // TODO: генерирование ошибки или запись ошибки
            return;
        }

        $result = $this->get($id);
        if (!$result) {
            return;
        }

        $this->id = $id;
        $this->setData($result);
    }


    public function get($id)
    {
        return $this->dataProvider->get($this, $id);
    }


    /**
     * Добавляем
     */
    public function add()
    {
        $id = $this->dataProvider->add($this);
        $this->setId($id ?: 0);

        return $this->id;
    }


    public function update()
    {
        return $this->dataProvider->update($this, $this->id);
    }


    public function delete()
    {
        return $this->dataProvider->delete($this, $this->id);
    }


    public function setData(array $data)
    {
        $this->data = $data;
    }


    public function setId($id)
    {
        $this->id = $this->data['id'] = $id;
    }


    public function getId()
    {
        return $this->id;
    }
}
