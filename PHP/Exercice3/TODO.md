# Exercise 3

One evening, two brothers take advantage of their parents' absence to order burgers. To avoid leaving a trace, one of them must go down the bins before midnight. They decide to play the game of battle. The principle is simple, each player has the same number of cards and each turn, each player presents a card. Whoever has the highest value card wins the point. If both cards have the same value, no one wins the point. The winner of the game is the one with the most points at the end.

The objective of this challenge is to determine who will not go down the trash tonight (winner of the game).

We will name the two brothers A and B. For simplicity, we will consider that the cards have values ​​ranging from 1 to 10. We guarantee that there is a winner at the end of the game (no possible equality between the two players).

In the $input variable, you will find an array with two dimention representing the set of turn, with the cards of each players. You must set 'A' or 'B' in the $winner variable to point out the winner.

input : [[2,3], ...]
winner : 'A'

To validate it, just cd into the Exercice3 folder and run "php phpunit-6.5.5.phar".
