<?php

class CardDistributor {

    /**
     * @param $people
     * @return false|string
     */
    public static function distribute($people)
    {
        // validate input
        if (!is_numeric($people) || $people < 0) {
            return json_encode(['error' => "Input value does not exist or value is invalid"]);
        }
        
        // Deck of cards data
        $deck = [];
        $types = ['S', 'H', 'D', 'C'];
        $cards = ['A','2','3','4','5','6','7','8','9','X','J','Q','K'];

        // combine card with type
        foreach ($types as $type) {
            foreach ($cards as $card) {
                $deck[] = "$type-$card";
            }
        }

        // shuffle the deck
        shuffle($deck);

        // distributing the cards
        $distribution = [];

        foreach ($deck as $i => $value) {
            $personIndex = $i % $people;
            if (!isset($distribution[$personIndex])) {
                $distribution[$personIndex] = [];
            }
            $distribution[$personIndex][] = $value;
        }

        // Format output
        $output = [];
        foreach ($distribution as $cardsForPerson) {
            $output[] = implode(',', $cardsForPerson);
        }

        return json_encode(["result" => implode("\n", $output)]);

    }

}