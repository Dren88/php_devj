<?php

/**
 * Класс Item
 */
final class Item {
    /**
     * Свойства класса
     *
     * Делаем свойства доступными только из класса применяя модификатор доступа private
     * Прописываем тип свойства
     */
    private int $id;
    private string $name;
    private int $status;
    private static bool $changed = false;
    /**
     * Конструктор класса
     *
     * В конструктор класса передается ID объекта и выполняется метод init, если свойство $changed равно false
     */
    public function __construct($id)
    {
        $this->id = $id;
        if(!self::$changed)
        {
            $this->init();
        }
    }
    /**
     * Получение свойств магическим методом
     */
    public function __get($name)
    {
        return $this->$name;
    }
    /**
     * Задание свойств магическим методом
     *
     * Исключаем свойство id и проверяем свойство на пустоту и соответствие типу
     */
    public function __set($name, $value)
    {
        if($name != 'id' && $value && gettype($this->$name) == gettype($value))
        {
            $this->$name = $value;
        }
    }
    /**
     * Описываем метод init
     *
     * В переменную $objects записываем результат выборки из БД(как это бы делалось, например, с помощью RedBean)
     * Результат зиписываем в свойства $name и $status
     */
    private function init(){
        self::$changed = true;
        $objects = \R::findOne('objects', 'id = ? LIMIT 1', [$this->id]);
        if($objects->name){
            $this->name = $objects->name;
        }
        if($objects->status){
            $this->status = $objects->status;
        }
    }
    /**
     * Описываем метод save
     *
     * Сохраняет установленные значения name и status
     */
    public function save($name, $status){
        $this->name = $name;
        $this->status = $status;
    }
}
