<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use App\Entity\NosPlats;
use App\Entity\Restaurant;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Faker\Factory::create('fr_FR');

        for($i = 1; $i <= 6; $i++){
             $restaurant = new Restaurant();

             $restaurant->setName($faker->name());
             $restaurant->setAddress($faker->address());
             $restaurant->setZip($faker->numberBetween(01000, 99000));
             $restaurant->setEmail($faker->email());
             $restaurant->setCity($faker->city());
             $restaurant->setDescription($faker->text(1000));
             $restaurant->setImg('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT51b-r3mlfMGiWXIRTlUXG6y7m9muz0Equ3g&usqp=CAU');
             $restaurant->setDate($faker->dateTime);

        $manager->persist($restaurant);
        
            }
        
        /*for($j = 1; $j <=4; $j++){
             $nos_plats = new NosPlats();

             $nos_plats->setName($faker->name());
             $nos_plats->setDescription($faker->text(1000));
             $nos_plats->setPrice($faker->randomFloat(2, 15, 100));
             $nos_plats->setImg('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT51b-r3mlfMGiWXIRTlUXG6y7m9muz0Equ3g&usqp=CAU');
             $nos_plats->setDate($faker->dateTime());

            $manager->persist($nos_plats);

        }*/
              
            $manager->flush();
    }
             
}
            
    
        
        

        

        
      
        


    
