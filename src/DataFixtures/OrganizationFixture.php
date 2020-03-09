<?php


namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Organization;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class OrganizationFixture extends BaseFixture implements FixtureGroupInterface
{

    public static function getGroups(): array
    {
        return ['guide_group'];
    }

    public function loadData(ObjectManager $manager)
    {
        $categories = $manager->getRepository(Category::class)->findAll();
        foreach ($categories as $category) {
            $this->createMany(Organization::class, rand(1, 5), function(Organization $organization, $count) use ($category) {
                $organization->setName($this->faker->company);
                $organization->setPhone($this->faker->phoneNumber);
                $organization->setAddress($this->faker->streetAddress);
                $organization->setDescription($this->faker->realText($this->faker->numberBetween(30,80)));
                $category->addOrganization($organization);
            });
        }

        $manager->flush();
    }
}