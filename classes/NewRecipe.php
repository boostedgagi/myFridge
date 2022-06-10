<?php

class NewRecipe extends Database
{

    protected function makeNewRecipeBase($title, $categoryID, $mealID, $time, $userEmail, $recipeImagePath): void
    {

        $sendRequest = $this->connect()->prepare('call makeNewRecipe(?,?,?,?,?,?);');

        if (!$sendRequest->execute(array($title, $categoryID, $mealID, $time, $userEmail, $recipeImagePath))) {
            $sendRequest = null;
            header("location: ../fridges.php?error=new_fridge_insert_failed");
            exit();
        }
        //return $this->connect()->lastInsertId();

//            $exactID = 0;
//
//            try {
//                $this->connect()->beginTransaction();
//                $sendRequest->execute(array($title, $categoryID, $mealID, $time, $userEmail, $recipeImagePath));
//                 $exactID = $this->connect()->lastInsertId();
//$this->connect()->commit();
//
//            } catch (PDOException $e) {
//                $this->connect()->rollback();
//                print "Error!: " . $e->getMessage() . "</br>";
//            }
//        }
//        catch( PDOException $e ) {
//            print "Error!: " . $e->getMessage() . "</br>";
//        }
//        return $exactID;


//    protected function insertRecipe($title, $categoryID, $mealID, $time, $userEmail, $recipeImagePath,array $ingredients){
//        $last_id = $this->makeNewRecipe($title, $categoryID, $mealID, $time, $userEmail, $recipeImagePath);
//        foreach($ingredients as $ingredient){
//            $insertIngredients = $this->connect()->prepare('call insertIngredient(?,?,?)');
//
//        }
//    }
        }

        public function lastInsertedId(){
            return $this->lastId();
        }

    }
