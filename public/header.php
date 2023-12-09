<!DOCTYPE html>
<html lang="en">
<head>
  <title>Header Design</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./public/style.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <style> body {
    font-family: 'Poppins', sans-serif;
    line-height: 1.5;
    margin: 0;
  }
  
  .container {
    max-width: 1170px;
    margin: auto;
  }
  
  .row {
    display: flex;
    flex-wrap: wrap;
  }
  
  .header {
    background-color: #4D6881;
    padding: 20px 0; /* Reduced padding for a smaller header */
  }
  
  .header-col {
    width: 33.3%;
    padding: 0 15px;
  }
  
  .header-col h1 {
    font-size: 18px;
    color: rgb(14, 14, 14);
    text-transform: capitalize;
    margin-bottom: 15px; /* Reduced margin for a smaller header */
    font-weight: 500;
    position: relative;
  }
  
  .header-col h1::before {
    content: '';
    position: absolute;
    left: 0;
    bottom: -5px; /* Adjusted position for a smaller header */
    background-color: #BDC4CD;
    height: 2px;
    box-sizing: border-box;
    width: 50px;
  }
  
  .header-col ul {
    list-style: none;
  }
  
  .header-col ul li {
    display: inline-block;
    margin-right: 20px;
  }
  
  .header-col ul li a {
    font-size: 16px;
    text-transform: capitalize;
    color: #ffffff;
    text-decoration: none;
    font-weight: 300;
    transition: all 0.3s ease;
  }
  
  .header-col ul li a:hover {
    color: #ffffff;
    padding-left: 8px;
  }
  
  @media (max-width: 767px) {
    .header-col {
      width: 100%; /* Full width on smaller screens */
      margin-bottom: 10px; /* Adjusted margin for a smaller header */
    }
  }
  
  @media (max-width: 574px) {
    .header-col {
      width: 100%;
    }
  }
  </style>
</head>
<body>

  <header class="header">
     <div class="container">
      <div class="row">
        <div class="header-col">
          <h1>Inda's clothing company</h1>
        </div>
        <div class="header-col">
        <ul><h1>Welcome to Inda's online website </h1></ul>
        </div>
        <div class="header-col">
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Products</a></li>
            <li><a href="#">Cart</a></li>
          </ul>
        </div>
        </div>
      </div>
     </div>
  </header>

</body>
</html>

