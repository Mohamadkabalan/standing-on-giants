<?php
$coktails=[];
// Parse the ingredients from the command line arguments
$ingredients = explode(',', $argv[1]);

//loop through ingredients
foreach ($ingredients as $ingredient){
  // Use the PHP cURL module to make a request to the external API
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "https://www.thecocktaildb.com/api/json/v1/1/filter.php?i=" . $ingredient);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($ch);

  // Parse the response and print the list of cocktails
  $response_data = json_decode($response, true);

  if($response_data){
    foreach ($response_data['drinks'] as $drink) {
      $coktails[]= $drink['strDrink'];
    }
  }
  $coktails = array_unique($coktails);
  foreach ($coktails as $coktail){
    echo $coktail. "\n";
  }

}

