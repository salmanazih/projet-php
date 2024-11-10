<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css    ">
    <link rel="stylesheet" href="./imagesweb/360_F_141032964_JwLF1Z3pdyF0If8L7gbvIeWiMUoflJqv.jpg" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Food Restaurant</title>
</head>
<body>
    <header>
        <div class="header">
            <div class="logo">
                <img src="./imagesweb/sushi-love-japanese-food-text-260nw-2299879521.webp" alt="">
            </div>
            <div class="bar">
                <i class="fa-solid fa-bars"></i>
                <i class="fa-solid fa-xmark"></i>


            </div>
        <div class="nav">
            <ul>
                <a href=""><li> Home</li></a>
                <a href=""><li>About Us</li></a>
                <a href=""><li>Menu</li></a>
                <a href=""><li>Book Table</li></a>
                    
            </ul>
        </div>
        <div class="email">
        <?php
        echo   $_SESSION['email'];
        ?>
        </div>
        <div class="account">
            <ul>
                <a href="#">
                    <li><i class="fa-solid fa-house-chimney"></i></li>
                </a>
                <a href="#" id="searchicon2">
                    <li><i class="fa-solid fa-magnifying-glass searchicon"></i></li>
                </a>
                <div class="search" id="searchinput2">
                    <input type="search" placeholder="Search...">
                    <i class="fa-solid fa-magnifying-glass srchicon"></i>
                </div>
                
                <a href="signin.php">
                    <li><i class="fa-solid fa-user" id="user-lap"></i></li>
                </a>
            </ul>

        </div>
    </div>
        
        
    </header>
    <div class="home">
        <div class="main-slide">
            <div>
                <h1>Roll with us<span> to experience true sushi bliss.</span></h1>
                <p>every dish reflects a commitment to quality, freshness, and the artistry of sushi. Indulge in our plates, where every bite is a step into the world of traditional Japanese dining. </p>
                <button class="red_btn">Visit Now <i class="fa-solid fa-arrow-right-long"></i></button>
            </div>
            <div>
                <img src="./imagesweb/COUV-ARTICLES-1920x1080-83-1024x576.jpg" alt="">
            </div>

        </div>
        

    </div>
    <div class="food-items">
        <div class="items">
            <div> 
                <img src="./imagesweb/asianshrimpsoup1.jpg" alt="">
            </div>
            <h1> Our Soups</h1>
            <p>aromatic dish that combines tender shrimp with a rich broth infused with spices.</p>
            <button class="white_btn">See Menu</button>
        </div>
        <div class="items">
            <div> 
                <img src="./imagesweb/pengin-sushi-untuk-buka-puasa-buat-aja-di-rumah-aGdArKlEg8.jpg" alt="">
            </div>
            <h1> Our Sushi</h1>
            <p> sushi features delicate, sweet shrimp atop perfectly seasoned rice, wrapped in a seaweed sheet.</p>
            <button class="white_btn">See Menu</button>
        </div>
        <div class="items">
            <div> 
                <img src="./imagesweb/pngtree-allfillet-fried-shrimp-image-image_13137816.png" alt="">
            </div>
            <h1> Our Plates</h1>
            <p>featuring plump shrimp coated in a light, flavorful batter and perfectly fried to create a crunchy exterior that contrasts with the juicy.</p>
            <button class="white_btn">See Menu</button>
        </div>
    </div>
    <div class="main_slide2">
        <div class="foodimg">
            <img src="./imagesweb/istockphoto-497027464-612x612.jpg" alt="">
        </div>
        <div class="quote">
            <h2>Why Our Restaurant</h2>
            <p>Our restaurant offers a warm and inviting atmosphere where tradition meets innovation. Every dish is crafted with the freshest seafood, premium ingredients, and a passion for delivering authentic Japanese flavors. From our signature rolls to delicate sashimi, each bite is a journey into the rich history and culture of sushi-making. Whether you're a sushi connoisseur or a newcomer, we promise a memorable dining experience that celebrates the beauty of Japanese cuisine. Come roll with us and indulge in a truly exquisite sushi experience!</p>
        </div>
    </div>
    <div class="drink-items">
        <div class="items1">
            <div> 
                <img src="./imagesweb/Cocktail-champagne-cremant-fruit-de-la-passion.jpeg" alt="">
            </div>
            <h1>Our Drink</h1>
            <p>A refreshing blend of flavors that quench your thirst and elevate your mood, perfect for any occasion.</p>
            <button class="green_btn">See Menu</button>
        </div>
        <div class="items1">
            <div> 
                <img src="./imagesweb/cocktail-drinks-6950673_1280.jpg" alt="">
            </div>
            <h1> Our Cocktail</h1>
            <p> A carefully crafted mix of premium spirits and exotic ingredients, offering a bold and sophisticated experience in every sip.</p>
            <button class="green_btn">See Menu</button>
        </div>
        <div class="items1">
            <div> 
                <img src="./imagesweb/cocktail-red-lion-6.jpg" alt="">
            </div>
            <h1> Our Juice</h1>
            <p>Freshly squeezed and bursting with natural sweetness, our juices are packed with vibrant, invigorating flavors.</p>
            <button class="green_btn">See Menu</button>
        </div>
    </div>
    
    <script src="script.js"></script>
</body>
</html>