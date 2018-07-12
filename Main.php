<?php

include "Autorization.php";

registration("Vard","Bakunc", "vard1@mail.ru","vardpass");
echo "<br/>";
if (checkUserExists("da145@gmail.com")){
    echo "Checked Email: true";
}
else{
    echo "Checked Email: false";
}
echo "<br/>";
login("mon4569@gmail.com","monpass");
echo "<br/>";
//ForgetPassword("mon4569@gmail.com", "monpass");
echo "<br/>";