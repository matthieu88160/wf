<?php

function getVectorAngle($vectorA, $vectorB) {
   
    $pi=pi();
   
    list($ax, $ay) = $vectorA;
    list($bx, $by) = $vectorB;
    
    $i=(acos((($ax*$ay)+($bx*$by))/(sqrt(($ax*$ax)+($bx*$bx))*sqrt(($ay*$ay)+($by*$by))))*360)/($pi*2);
   
    return $i;
}