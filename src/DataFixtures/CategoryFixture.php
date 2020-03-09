<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Category;

class CategoryFixture extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['guide_group'];
    }

    public function load(ObjectManager $manager)
    {
        $categoryItems = array(
            array(
                "name" => "Медицина",
                "subcategories" => [
                    array("name" => "Аптеки"),
                    array("name" => "Больницы"),
                    array("name" => "Стоматологии")
                ]
            ),
            array(
                "name" => "Спорт",
                "subcategories" => [
                    array("name" => "Спорткомплексы"),
                    array("name" => "Фитнес-клубы")
                ]
            ),
            array(
                "name" => "Услуги",
                "subcategories" => [
                    array("name" => "Перевозки"),
                    array("name" => "Финансы"),
                    array("name" => "Недвижимость"),
                    array("name" => "Юридические услуги")
                ]
            ),
            array(
                "name" => "Автосервис",
                "subcategories" => [
                    array("name" => "Шиномонтаж"),
                    array("name" => "Заправки")
                ]
            ),
            array(
                "name" => "Туризм",
                "subcategories" => [
                    array("name" => "Гостиницы")
                ]
            ),
            array(
                "name" => "Продукты",
                "subcategories" => [
                    array("name" => "Суепрмаркеты")
                ]
            ),
            array(
                "name" => "Образование",
                "subcategories" => [
                    array("name" => "Детские сады"),
                    array("name" => "Среднее образование"),
                    array("name" => "Проф. образование")
                ]
            ),
            array(
                "name" => "B2B-услуги",
                "subcategories" => [
                    array("name" => "Реклама")
                ]
            )
        );

        foreach ($categoryItems as $categoryItem) {
            $category = new Category();
            $category->setName($categoryItem["name"]);
            $manager->persist($category);
            if (isset($categoryItem['subcategories'])) {
                foreach ($categoryItem['subcategories'] as $subcategoryItem) {
                    $subCategory = new Category();
                    $subCategory->setName($subcategoryItem["name"]);
                    $subCategory->setParent($category);
                    $manager->persist($subCategory);
                }
            }
        }

        $manager->flush();
    }
}