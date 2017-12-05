
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>
      Welcome to FlatShop
    </title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,700,500italic,100italic,100' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen"/>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
    <script src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.js" type="text/javascript"></script>
    <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js">
</script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js">
</script>
<![endif]-->
  </head>
  <body>
    <div class="wrapper">
      <div class="header">
        <div class="container">
          <div class="row">
            <div class="col-md-2 col-sm-2">
              <div class="logo">
                <a href="/Trang-Chu">
                  <img src="images/logo.png" alt="FlatShop">
                </a>
              </div>
            </div>
            <div class="col-md-10 col-sm-10">
              <div class="header_top">
                <div class="row">
                  <div class="col-md-3">
                    <ul class="option_nav">
                      <li class="dorpdown">
                        <a href="#">
                          Eng
                        </a>
                        <ul class="subnav">
                          <li>
                            <a href="#">
                              Eng
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              Vns
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              Fer
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              Gem
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="dorpdown">
                        <a href="#">
                          USD
                        </a>
                        <ul class="subnav">
                          <li>
                            <a href="#">
                              USD
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              UKD
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              FER
                            </a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-6">
                    <ul class="topmenu">
                      <li>
                        <a href="#">
                          About Us
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          News
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          Service
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          Recruiment
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          Media
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          Support
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3">
                    <ul class="usermenu">
                      @if(isset($user))
                        <li><a href="register={{$user->userID}}" class="log">{{$user->username}}</a></li> 
                        <li><a href="/logout" class="reg" >LogOut</a></li>
                     @else
                        <li><a href="login" class="log">Login</a></li>
                        <li><a href="register" class="reg">Register</a></li>
                     @endif                                                               
                    </ul>
                  </div>
                </div>
              </div>
              <div class="clearfix">
              </div>
              <div class="header_bottom">
                <ul class="option">
                  <li id="search" class="search">
                    <form>
                      <input class="search-submit" type="submit" value="">
                      <input class="search-input" placeholder="Enter your search term..." type="text" value="" name="search">
                    </form>
                  </li>
                  <li class="option-cart">
                    <a href="#" class="cart-icon">cart <span class="cart_no" id="cart_no">{{Cookie::get('amount') < 10 ? '0'.Cookie::get('amount') : Cookie::get('amount')}}</span></a>
                    <ul class="option-cart-item"> 
                       <div class="list-order">
                          <?php                                                             
                             $ls_order = App\Order::where('userID',Auth::check() ? Auth::id() : Cookie::get('user_ip'))->where('isActive',1)->orderBy('orderID','desc')->limit(Cookie::get('amount'))->get();                                             
                             $total = 0;
                             foreach($ls_order as $order){
                                $prd = App\Product::find($order->productID);
                                $total+= $prd->price;
                                ?>
                                   <li>
                                      <div class="cart-item"><div class="image"><img src="{{$prd->pictures}}" alt=""></div>
                                         <div class="item-description">
                                            <p class="name">{{$prd->productname}}</p>
                                            <p>Size: <span class="light-red">One size</span><br>Quantity: <span class="light-red">01</span></p>
                                         </div>
                                         <div class="right"><p class="price">${{$prd->price}}.00</p>
                                            <a href="/delete-order?id={{$order->orderID}}" class="remove"><img src="images/remove.png" alt="remove"></a>
                                         </div>
                                      </div>
                                   </li>
                                <?php
                             }                                                    
                          ?>                                     
                       </div>     
                       <div class="total-cart">
                          @if(count($ls_order) > 0)                                  
                             <li><span class="total">Total <strong id="total">${{$total}}</strong></span><button class="login" onClick="location.href='/cart'">CheckOut</button></li>
                          @else
                             <li>Bạn Chưa Order Sản Phẩm Nào.</li>
                          @endif
                       </div>                                                               
                    </ul>
                 </li>
                </ul>
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">
                      Toggle navigation
                    </span>
                    <span class="icon-bar">
                    </span>
                    <span class="icon-bar">
                    </span>
                    <span class="icon-bar">
                    </span>
                  </button>
                </div>
                <div class="navbar-collapse collapse">
                  <ul class="nav navbar-nav">
                    <li class="active dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Home
                      </a>
                      <div class="dropdown-menu">
                        <ul class="mega-menu-links">
                          <li>
                            <a href="/Trang-Chu">
                              home
                            </a>
                          </li>
                          <li>
                            <a href="home2">
                              home2
                            </a>
                          </li>
                          <li>
                            <a href="home3">
                              home3
                            </a>
                          </li>
                          <li>
                            <a href="productlitst">
                              Productlitst
                            </a>
                          </li>
                          <li>
                            <a href="productgird">
                              Productgird
                            </a>
                          </li>
                          <li>
                            <a href="details">
                              Details
                            </a>
                          </li>
                          <li>
                            <a href="cart">
                              Cart
                            </a>
                          </li>
                          <li>
                            <a href="login">
                              CheckOut
                            </a>
                          </li>
                          <li>
                            <a href="register">
                              CheckOut2
                            </a>
                          </li>
                          <li>
                            <a href="contact">
                              contact
                            </a>
                          </li>
                        </ul>
                      </div>
                    </li>
                    <li>
                      <a href="productgird">
                        men
                      </a>
                    </li>
                    <li>
                      <a href="productlitst">
                        women
                      </a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Fashion
                      </a>
                      <div class="dropdown-menu mega-menu">
                        <div class="row">
                          <div class="col-md-6 col-sm-6">
                            <ul class="mega-menu-links">
                              <li>
                                <a href="productgird">
                                  New Collection
                                </a>
                              </li>
                              <li>
                                <a href="productgird">
                                  Shirts & tops
                                </a>
                              </li>
                              <li>
                                <a href="productgird">
                                  Laptop & Brie
                                </a>
                              </li>
                              <li>
                                <a href="productgird">
                                  Dresses
                                </a>
                              </li>
                              <li>
                                <a href="productgird">
                                  Blazers & Jackets
                                </a>
                              </li>
                              <li>
                                <a href="productgird">
                                  Shoulder Bags
                                </a>
                              </li>
                            </ul>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <ul class="mega-menu-links">
                              <li>
                                <a href="productgird">
                                  New Collection
                                </a>
                              </li>
                              <li>
                                <a href="productgird">
                                  Shirts & tops
                                </a>
                              </li>
                              <li>
                                <a href="productgird">
                                  Laptop & Brie
                                </a>
                              </li>
                              <li>
                                <a href="productgird">
                                  Dresses
                                </a>
                              </li>
                              <li>
                                <a href="productgird">
                                  Blazers & Jackets
                                </a>
                              </li>
                              <li>
                                <a href="productgird">
                                  Shoulder Bags
                                </a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <a href="productgird">
                        gift
                      </a>
                    </li>
                    <li>
                      <a href="productgird">
                        kids
                      </a>
                    </li>
                    <li>
                      <a href="productgird">
                        blog
                      </a>
                    </li>
                    <li>
                      <a href="productgird">
                        jewelry
                      </a>
                    </li>
                    <li>
                      <a href="contact">
                        contact us
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="clearfix">
        </div>
        <div class="page-/">
          <div class="container">
            <p>
              Home - Shopping Cart
            </p>
          </div>
        </div>
      </div>
      <div class="clearfix">
      </div>
      <div class="container_fullwidth">
        <div class="container shopping-cart">
          <div class="row">
            <div class="col-md-12">
              <h3 class="title">
                Shopping Cart
              </h3>
              <div class="clearfix">
              </div>
              <table class="shop-table">
                <thead>
                  <tr>
                    <th>
                      Image
                    </th>
                    <th>
                      Dtails
                    </th>
                    <th>
                      Price
                    </th>
                    <th>
                      Quantity
                    </th>
                    <th>
                      Price
                    </th>
                    <th>
                      Delete
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php                                                             
                   $ls_order = App\Order::where('userID',Auth::check() ? Auth::id() : Cookie::get('user_ip'))->where('isActive',1)->orderBy('orderID','desc')->limit(Cookie::get('amount'))->get();
                   $total = 0;
                   if(count($ls_order) > 0){
                      foreach($ls_order as $order){
                        $prd = App\Product::find($order->productID);
                        $price = (int)$prd->price * (int)$order->amount;
                        $total+= $price;                                            
                        ?>
                        <tr> 
                          <td><img src="{{$prd->pictures}}" alt=""></td>
                          <td>
                            <div class="shop-details">
                              <div class="productname">{{$prd->productname}}</div>
                              <p>
                                <img alt="" src="images/star.png">
                                <a class="review_num" href="#">02 Review(s)</a>
                              </p>
                              <div class="color-choser">
                                <span class="text">Product Color : </span>
                                <ul>
                                  <li><a class="black-bg " href="#">black</a></li>
                                  <li><a class="red-bg" href="#">light red</a></li>
                                </ul>
                              </div>
                              <p>Product Code : <strong class="pcode">Dress 120</strong></p>
                            </div>
                          </td>
                          <td><h5>${{$prd->price}}</h5></td>
                          <td>
                            <select name="">
                              <option value="1" {{$order->amount== "1"?'selected':''}}>1</option>
                              <option value="2" {{$order->amount== "2"?'selected':''}}>2</option>
                              <option value="3" {{$order->amount== "3"?'selected':''}}>3</option>
                            </select>
                          </td>
                          <td><h5><strong class="red">${{$price}}</strong></h5></td>
                          <td><a href="/delete-order?id={{$order->orderID}}"><img src="images/remove.png" alt=""></a></td>
                        </tr>
                        <?php
                      }
                   }else{
                      echo '<tr><td class="btn-warning"><h3>Bạn Chưa Order Sản Phẩm Nào.</h3></td></tr>';
                   }                   
                  ?>                  
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="6">
                      <a href="/Trang-Chu"><button class="pull-left">
                        Continue Shopping
                      </button></a>                      
                    </td>
                  </tr>
                </tfoot>
              </table>
              <div class="clearfix">
              </div>
              <div class="row">
                <div class="col-md-4 col-sm-6">
                  <div class="shippingbox">
                    <h5>
                      Estimate Shipping And Tax
                    </h5>
                    <form>
                      <label>
                        Select Country *
                      </label>
                      <select class="">
                        <option value="AL">
                          Alabama
                        </option>
                        <option value="AK">
                          Alaska
                        </option>
                        <option value="AZ">
                          Arizona
                        </option>
                        <option value="AR">
                          Arkansas
                        </option>
                        <option value="CA">
                          California
                        </option>
                        <option value="CO">
                          Colorado
                        </option>
                        <option value="CT">
                          Connecticut
                        </option>
                        <option value="DE">
                          Delaware
                        </option>
                        <option value="DC">
                          District Of Columbia
                        </option>
                        <option value="FL">
                          Florida
                        </option>
                        <option value="GA">
                          Georgia
                        </option>
                        <option value="HI">
                          Hawaii
                        </option>
                        <option value="ID">
                          Idaho
                        </option>
                        <option selected="" value="IL">
                          Illinois
                        </option>
                        <option value="IN">
                          Indiana
                        </option>
                        <option value="IA">
                          Iowa
                        </option>
                        <option value="KS">
                          Kansas
                        </option>
                        <option value="KY">
                          Kentucky
                        </option>
                        <option value="LA">
                          Louisiana
                        </option>
                        <option value="ME">
                          Maine
                        </option>
                        <option value="MD">
                          Maryland
                        </option>
                        <option value="MA">
                          Massachusetts
                        </option>
                        <option value="MI">
                          Michigan
                        </option>
                        <option value="MN">
                          Minnesota
                        </option>
                        <option value="MS">
                          Mississippi
                        </option>
                        <option value="MO">
                          Missouri
                        </option>
                        <option value="MT">
                          Montana
                        </option>
                        <option value="NE">
                          Nebraska
                        </option>
                        <option value="NV">
                          Nevada
                        </option>
                        <option value="NH">
                          New Hampshire
                        </option>
                        <option value="NJ">
                          New Jersey
                        </option>
                        <option value="NM">
                          New Mexico
                        </option>
                        <option value="NY">
                          New York
                        </option>
                        <option value="NC">
                          North Carolina
                        </option>
                        <option value="ND">
                          North Dakota
                        </option>
                        <option value="OH">
                          Ohio
                        </option>
                        <option value="OK">
                          Oklahoma
                        </option>
                        <option value="OR">
                          Oregon
                        </option>
                        <option value="PA">
                          Pennsylvania
                        </option>
                        <option value="RI">
                          Rhode Island
                        </option>
                        <option value="SC">
                          South Carolina
                        </option>
                        <option value="SD">
                          South Dakota
                        </option>
                        <option value="TN">
                          Tennessee
                        </option>
                        <option value="TX">
                          Texas
                        </option>
                        <option value="UT">
                          Utah
                        </option>
                        <option value="VT">
                          Vermont
                        </option>
                        <option value="VA">
                          Virginia
                        </option>
                        <option value="WA">
                          Washington
                        </option>
                        <option value="WV">
                          West Virginia
                        </option>
                        <option value="WI">
                          Wisconsin
                        </option>
                        <option value="WY">
                          Wyoming
                        </option>
                      </select>
                      <label>
                        State / Province *
                      </label>
                      <select class="">
                        <option value="AL">
                          Alabama
                        </option>
                        <option value="AK">
                          Alaska
                        </option>
                        <option value="AZ">
                          Arizona
                        </option>
                        <option value="AR">
                          Arkansas
                        </option>
                        <option value="CA">
                          California
                        </option>
                        <option value="CO">
                          Colorado
                        </option>
                        <option value="CT">
                          Connecticut
                        </option>
                        <option value="DE">
                          Delaware
                        </option>
                        <option value="DC">
                          District Of Columbia
                        </option>
                        <option value="FL">
                          Florida
                        </option>
                        <option value="GA">
                          Georgia
                        </option>
                        <option value="HI">
                          Hawaii
                        </option>
                        <option value="ID">
                          Idaho
                        </option>
                        <option selected="" value="IL">
                          Illinois
                        </option>
                        <option value="IN">
                          Indiana
                        </option>
                        <option value="IA">
                          Iowa
                        </option>
                        <option value="KS">
                          Kansas
                        </option>
                        <option value="KY">
                          Kentucky
                        </option>
                        <option value="LA">
                          Louisiana
                        </option>
                        <option value="ME">
                          Maine
                        </option>
                        <option value="MD">
                          Maryland
                        </option>
                        <option value="MA">
                          Massachusetts
                        </option>
                        <option value="MI">
                          Michigan
                        </option>
                        <option value="MN">
                          Minnesota
                        </option>
                        <option value="MS">
                          Mississippi
                        </option>
                        <option value="MO">
                          Missouri
                        </option>
                        <option value="MT">
                          Montana
                        </option>
                        <option value="NE">
                          Nebraska
                        </option>
                        <option value="NV">
                          Nevada
                        </option>
                        <option value="NH">
                          New Hampshire
                        </option>
                        <option value="NJ">
                          New Jersey
                        </option>
                        <option value="NM">
                          New Mexico
                        </option>
                        <option value="NY">
                          New York
                        </option>
                        <option value="NC">
                          North Carolina
                        </option>
                        <option value="ND">
                          North Dakota
                        </option>
                        <option value="OH">
                          Ohio
                        </option>
                        <option value="OK">
                          Oklahoma
                        </option>
                        <option value="OR">
                          Oregon
                        </option>
                        <option value="PA">
                          Pennsylvania
                        </option>
                        <option value="RI">
                          Rhode Island
                        </option>
                        <option value="SC">
                          South Carolina
                        </option>
                        <option value="SD">
                          South Dakota
                        </option>
                        <option value="TN">
                          Tennessee
                        </option>
                        <option value="TX">
                          Texas
                        </option>
                        <option value="UT">
                          Utah
                        </option>
                        <option value="VT">
                          Vermont
                        </option>
                        <option value="VA">
                          Virginia
                        </option>
                        <option value="WA">
                          Washington
                        </option>
                        <option value="WV">
                          West Virginia
                        </option>
                        <option value="WI">
                          Wisconsin
                        </option>
                        <option value="WY">
                          Wyoming
                        </option>
                      </select>
                      <label>
                        Zip / Post Code *
                      </label>
                      <select class="">
                        <option value="AL">
                          Alabama
                        </option>
                        <option value="AK">
                          Alaska
                        </option>
                        <option value="AZ">
                          Arizona
                        </option>
                        <option value="AR">
                          Arkansas
                        </option>
                        <option value="CA">
                          California
                        </option>
                        <option value="CO">
                          Colorado
                        </option>
                        <option value="CT">
                          Connecticut
                        </option>
                        <option value="DE">
                          Delaware
                        </option>
                        <option value="DC">
                          District Of Columbia
                        </option>
                        <option value="FL">
                          Florida
                        </option>
                        <option value="GA">
                          Georgia
                        </option>
                        <option value="HI">
                          Hawaii
                        </option>
                        <option value="ID">
                          Idaho
                        </option>
                        <option selected="" value="IL">
                          Illinois
                        </option>
                        <option value="IN">
                          Indiana
                        </option>
                        <option value="IA">
                          Iowa
                        </option>
                        <option value="KS">
                          Kansas
                        </option>
                        <option value="KY">
                          Kentucky
                        </option>
                        <option value="LA">
                          Louisiana
                        </option>
                        <option value="ME">
                          Maine
                        </option>
                        <option value="MD">
                          Maryland
                        </option>
                        <option value="MA">
                          Massachusetts
                        </option>
                        <option value="MI">
                          Michigan
                        </option>
                        <option value="MN">
                          Minnesota
                        </option>
                        <option value="MS">
                          Mississippi
                        </option>
                        <option value="MO">
                          Missouri
                        </option>
                        <option value="MT">
                          Montana
                        </option>
                        <option value="NE">
                          Nebraska
                        </option>
                        <option value="NV">
                          Nevada
                        </option>
                        <option value="NH">
                          New Hampshire
                        </option>
                        <option value="NJ">
                          New Jersey
                        </option>
                        <option value="NM">
                          New Mexico
                        </option>
                        <option value="NY">
                          New York
                        </option>
                        <option value="NC">
                          North Carolina
                        </option>
                        <option value="ND">
                          North Dakota
                        </option>
                        <option value="OH">
                          Ohio
                        </option>
                        <option value="OK">
                          Oklahoma
                        </option>
                        <option value="OR">
                          Oregon
                        </option>
                        <option value="PA">
                          Pennsylvania
                        </option>
                        <option value="RI">
                          Rhode Island
                        </option>
                        <option value="SC">
                          South Carolina
                        </option>
                        <option value="SD">
                          South Dakota
                        </option>
                        <option value="TN">
                          Tennessee
                        </option>
                        <option value="TX">
                          Texas
                        </option>
                        <option value="UT">
                          Utah
                        </option>
                        <option value="VT">
                          Vermont
                        </option>
                        <option value="VA">
                          Virginia
                        </option>
                        <option value="WA">
                          Washington
                        </option>
                        <option value="WV">
                          West Virginia
                        </option>
                        <option value="WI">
                          Wisconsin
                        </option>
                        <option value="WY">
                          Wyoming
                        </option>
                      </select>
                      <div class="clearfix">
                      </div>
                      <button>
                        Get A Qoute
                      </button>
                    </form>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6">
                  <div class="shippingbox">
                    <h5>
                      Discount Codes
                    </h5>
                    <form>
                      <label>
                        Enter your coupon code if you have one
                      </label>
                      <input type="text" name="">
                      <div class="clearfix">
                      </div>
                      <button>
                        Get A Qoute
                      </button>
                    </form>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6">
                  <div class="shippingbox">                    
                    <div class="grandtotal">
                      <h5>
                        GRAND TOTAL 
                      </h5>
                      <span>
                        ${{$total}}
                      </span>
                    </div>
                    <button id="pay">
                      Thanh Toán
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <script type="text/javascript">
            $(document).ready(function(){
              $('#pay').click(function(){
                var type = {{$type}}
                if(type == 0){
                     if(confirm('Bạn có muốn đăng nhập?')){
                        document.location = '/login';   
                     }else{
                        $('#openModal').click();
                     }
                  }else{
                      alert("Đặt Hàng Thành Công.");
                     document.location = '/mail';
                  }
                return false;
              });
            });
          </script>
          <button type="button" id="openModal" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

          <!-- Modal -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Thông tin khách hàng</h4>
                </div>
                <form class="modal-body" method="post" id="update_user">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-row">
                    <label class="lebel-abs">
                      Tên  
                      <strong class="red">
                        *
                      </strong>
                    </label>
                    <input type="text" class="input namefild" name="nameOrder" id="nameOrder" required>                    
                  </div>
                  <div class="form-row">
                    <label class="lebel-abs">
                      Địa chỉ
                      <strong class="red">
                        *
                      </strong>
                    </label>
                    <input type="text" class="input namefild" name="address" required> 
                  </div>
                  <div class="form-row">
                    <label class="lebel-abs">
                      Số điện thoại
                      <strong class="red">
                        *
                      </strong>
                    </label>
                    <input type="number" class="input namefild" name="telephone" required>
                  </div>
                  <div class="form-row">
                    <label class="lebel-abs">
                      Email
                      <strong class="red">
                        *
                      </strong>
                    </label>
                    <input type="email" class="input namefild" name="email">
                  </div>
          
                <div class="modal-footer">
                  <button type="submit" class="btn btn-success" >Đặt Hàng</button>
                </div>
              </div>
            </form> 
            </div>

          <script type="text/javascript">
            $(document).ready(function(){
               $.ajaxSetup({
                headers: {
                  'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                }
              }); 

              $("#update_user").validate({          
                   submitHandler: submitFormUpdateUser
              });              
              function submitFormUpdateUser(){                      
                  var id = "<?php echo Cookie::get('user_ip')?>";                                                
                  var data = $('#update_user').serialize();                                    
                  $.ajax({
                      type : 'POST',
                      url  : '/update-customer?id='+id,
                      data : data,                                        
                      success:  function(data)
                      {        
                        if(data == "true"){
                          alert("Đặt Hàng Thành Công.");
                          document.location = '/mail';
                        }                                                         
                      }
                  });
                  return false;
              }       
            });
          </script>
          <div class="clearfix">
          </div>
          <div class="our-brand">
            <h3 class="title">
              <strong>
                Our 
              </strong>
              Brands
            </h3>
            <div class="control">
              <a id="prev_brand" class="prev" href="#">
                &lt;
              </a>
              <a id="next_brand" class="next" href="#">
                &gt;
              </a>
            </div>
            <ul id="braldLogo">
              <li>
                <ul class="brand_item">
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/envato.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/themeforest.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/photodune.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/activeden.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/envato.png" alt="">
                      </div>
                    </a>
                  </li>
                </ul>
              </li>
              <li>
                <ul class="brand_item">
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/envato.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/themeforest.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/photodune.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/activeden.png" alt="">
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="brand-logo">
                        <img src="images/envato.png" alt="">
                      </div>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="clearfix">
      </div>
      <div class="footer">
        <div class="footer-info">
          <div class="container">
            <div class="row">
              <div class="col-md-3">
                <div class="footer-logo">
                  <a href="#">
                    <img src="images/logo.png" alt="">
                  </a>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <h4 class="title">
                  Contact 
                  <strong>
                    Info
                  </strong>
                </h4>
                <p>
                  No. 08, Nguyen Trai, Hanoi , Vietnam
                </p>
                <p>
                  Call Us : (084) 1900 1008
                </p>
                <p>
                  Email : michael@leebros.us
                </p>
              </div>
              <div class="col-md-3 col-sm-6">
                <h4 class="title">
                  Customer
                  <strong>
                    Support
                  </strong>
                </h4>
                <ul class="support">
                  <li>
                    <a href="#">
                      FAQ
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      Payment Option
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      Booking Tips
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      Infomation
                    </a>
                  </li>
                </ul>
              </div>
              <div class="col-md-3">
                <h4 class="title">
                  Get Our 
                  <strong>
                    Newsletter 
                  </strong>
                </h4>
                <p>
                  Lorem ipsum dolor ipsum dolor.
                </p>
                <form class="newsletter">
                  <input type="text" name="" placeholder="Type your email....">
                  <input type="submit" value="SignUp" class="button">
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="copyright-info">
          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <p>
                  Copyright © 2012. Designed by 
                  <a href="#">
                    Michael Lee
                  </a>
                  . All rights reseved
                </p>
              </div>
              <div class="col-md-6">
                <ul class="social-icon">
                  <li>
                    <a href="#" class="linkedin">
                    </a>
                  </li>
                  <li>
                    <a href="#" class="google-plus">
                    </a>
                  </li>
                  <li>
                    <a href="#" class="twitter">
                    </a>
                  </li>
                  <li>
                    <a href="#" class="facebook">
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function(){
        $.getJSON('//freegeoip.net/json/?callback=?', function(data) {
               console.log(JSON.stringify(data, null, 2));
            });
      });
    </script>
    <!-- Bootstrap core JavaScript==================================================-->
    <script type="text/javascript" src="js/jquery-1.10.2.min.js">
    </script>
    <script type="text/javascript" src="js/bootstrap.min.js">
    </script>
    <script defer src="js/jquery.flexslider.js">
    </script>
    <script type="text/javascript" src="js/jquery.carouFredSel-6.2.1-packed.js">
    </script>
    <script type="text/javascript" src="js/script.min.js" >
    </script>
  </body>
</html>