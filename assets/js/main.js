/* Cookies are: for x=1 to N : imgx | namex | pricex (prixunitaire!) | quantityx | total and cartquantity */
/* Fel Cart el names are itemx : itemxquantity | itemxname | itemx price | onclick="sup(1)" */
/* Fel Produits el names are : namex | pricex | imgx */

function searchfn(id,nom,categ,pr){
  var elems = document.querySelector('.elements');
  var input = document.querySelector('#search');
  var ul = document.querySelector('#elemsul');
  ul.innerHTML="";
  var wid = input.clientWidth; //width

  //input
  let inp = input.value;
  let checkinp = inp.toUpperCase();
  //elems mel base
  let tabid = id.split(',');
  let tabnom = nom.split(',');
  let tabcateg = categ.split(',');
  //elems mel base upper
  let checkid = id.toUpperCase().split(',');
  let checknom = nom.toUpperCase().split(',');
  //elems mel base confirmed
  let confid = [];
  let confnom = [];
  let confcateg = [];

  if (inp.value != ""){
    elems.style="visibility: visible !important;opacity: 1;width:"+wid+"px;";

    for(let i=0;i<checkid.length;i++){
      if(checknom[i].includes(checkinp)){
        confid.push(tabid[i]);
        confnom.push(tabnom[i]);
        confcateg.push(tabcateg[i]);
      }
    }

    for (let i=0;i<confid.length;i++){
      let li = document.createElement("li");
      let a1 = document.createElement("a");
      let div2 = document.createElement("span");

      //td class "elemspic"
      let img1=document.createElement("img");
      img1.setAttribute("width","72px");
      img1.setAttribute("height","72px");
      img1.setAttribute("src","http://localhost/sbrnet/assets/img/"+confid[i]+".jpg");
      img1.setAttribute("alt","");
      img1.classList.add("elemspic");
      a1.appendChild(img1);

      //td class "elemstext"
      let h6=document.createElement("h6");
      h6.innerHTML= confnom[i];
      h6.style.color="#50cf80";
      div2.appendChild(h6);
      div2.classList.add("elemstext");
      a1.appendChild(div2);
      pr == '1'?
        a1.setAttribute('href','prod/prod.php?cat='+confcateg[i]+'#img'+confid[i])
        :a1.setAttribute('href','prod.php?cat='+confcateg[i]+'#img'+confid[i]);


      li.appendChild(a1);
      ul.appendChild(li);
    }
  }
  else {
    elems.style="visibility: hidden !important;opacity: 0;width:"+wid+"px;";
  }
}

function newsletter(){
  //email
  var email =  document.getElementById('emailnews').value;
  if (email == "") {
      document.querySelector('.statusnews').innerText = "Veuillez remplir votre email!";
      return false;
  } else {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      if(!re.test(email)){
          document.querySelector('.statusnews').innerText = "Format d'email invalide!";
          return false;
      }
  }
  $.ajax({
    type: 'POST',
    url: 'newsletter.php',
    data: {email:email},
    success: function(data){
      document.querySelector('.statusnews').innerText = "Email envoyé!";
      // location.reload();
    },
    error: function(data){
      document.querySelector('.statusnews').innerText = "Erreur d'envoi.";
    }
  });
}

function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  let expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

//Checking cookies for the id x
function CheckCookieById(x){
  if(getCookie("price"+x)!="" && getCookie("price"+x)!=null
    && getCookie("quantity"+x)!="" && getCookie("quantity"+x)!=null
    && getCookie("name"+x)!="" && getCookie("name"+x)!=null)
    return true;
  else
    return false;
}

//checkout add element
function checkoutajt(){
  let cart = document.getElementById("cart-items");
  if(cart.childElementCount<=0){
    location.assign('prod/prod.php?cat=huilesess');
  }
  else{
    let ordertable = document.getElementById("order-table");
    let subtotal = document.getElementById("subtotalprix");
    let total = document.getElementById("totalprix");
    var price;
    var name;
    var quantity;
    var li;
    var s = cart.childElementCount;
    var x = 1;
    var tot = 0;

    var test;

    //Je suppose eli mratbin fel cart asemehom "item+x" mel 1 hata lel ekher
    while (s!=0){
      test=document.getElementById("item"+x);
      if(test!=null){
        name=document.getElementById("item"+x+"name").textContent;
        price=document.getElementById("item"+x+"price").textContent;
        quantity=document.getElementById("item"+x+"quantity").textContent;

        li = document.createElement("li");
        li.classList.add("fw-normal");
        li.innerHTML= name+" x "+quantity+" <span>"+price+" DT</span>";

        ordertable.insertAdjacentElement("beforeend",li);
        s--;
        tot=parseInt(tot)+parseInt(price)*parseInt(quantity);
      }
      x++;
    }
    subtotal.innerHTML=tot;
    total.innerHTML=parseInt(tot)+7; //Frais de Livraison 7dt
  }
}

//Updating cookies to the current page's cart elements
function updatecookie(){
    let total=document.getElementById("totalprice");
    let tot=0;
    var s;
    if(getCookie("cartquantity") && ! getCookie("post"))
      s = parseInt(getCookie("cartquantity")); //decompteur s
    else
      s=0;

    if(s>0){ //ken cartquantity>0
      var x = 1;

      while (s!=0){ //or s != null or sthg
        if(CheckCookieById(x)){
          //ajt(x) :

          let table=document.getElementById("cart-items");
          let cartquantity=document.getElementById("cartquantity");

          let img="http://localhost/sbrnet/assets/img/"+x+".jpg";
          let price=getCookie("price"+x);
          let quantity=getCookie("quantity"+x);
          let name=getCookie("name"+x);

          let tr = document.createElement("tr");
          tr.setAttribute("id","item"+x); //<tr id="item"+x></tr>
          let td1 = document.createElement("td");
          let td2 = document.createElement("td");
          let td3 = document.createElement("td");

          //td class "si-pic"
          let img1=document.createElement("img");
          img1.setAttribute("width","72px");
          img1.setAttribute("height","72px");
          img1.setAttribute("src",img);
          img1.setAttribute("alt","");
          td1.appendChild(img1);
          td1.classList.add("si-pic");

          //td class "si-text"
          let div1=document.createElement("div");
          div1.classList.add("product-selected");
          //p tekhou itemxprice et itemxquantity
          let p1=document.createElement("p");
          //creating spans
          let spa1=document.createElement("span");
          spa1.setAttribute("id",'item'+x+'price');
          spa1.innerText=price;

          let spa2=document.createElement("span");
          spa2.setAttribute("id",'item'+x+'quantity');
          spa2.innerText=quantity;

          let t=document.createTextNode("DT x ")

          p1.appendChild(spa1);
          p1.append(t);
          p1.appendChild(spa2);

          //h6 tekhou nom
          let h6=document.createElement("h6");
          h6.setAttribute("id","item"+x+"name");
          h6.textContent=name;
          h6.style.color="#50cf80";
          div1.appendChild(p1);
          div1.appendChild(h6);
          td2.appendChild(div1);
          td2.classList.add("si-text");

          //td class "si-close"
          let btn1=document.createElement("button");
          btn1.setAttribute("type","button");
          btn1.classList.add("btn-close");
          btn1.setAttribute("disabled","");
          btn1.setAttribute("arialabel","Close");
          td3.appendChild(btn1);
          td3.setAttribute("onclick","sup("+x+")");
          td3.classList.add("si-close");

          //tr id "item"+x
          tr.appendChild(td1);
          tr.appendChild(td2);
          tr.appendChild(td3);
          table.appendChild(tr);

          //Ajout Quantité panier
          cartquantity.innerHTML=parseInt(getCookie("cartquantity"));

          tot += price * quantity;

          s--;
        }
        x++;
      }
      //Ajout Total panier
      total.innerHTML=parseInt(tot);
    
    }
    else{ //ken cartquantity<=0 //resetting l panier
      var cookies = document.cookie.split(";");

      for (var i = 0; i < cookies.length; i++) {
          var cookie = cookies[i];
          var eqPos = cookie.indexOf("=");
          var name = eqPos > -1 ? cookie.substring(0, eqPos) : cookie;
          setCookie(name,"",0);
      }
    }
}

//cart add element (mel produits.html) (Pricex prix unitaire rahi)
function ajt(x){
  let table=document.getElementById("cart-items");
  let cartquantity=document.getElementById("cartquantity");

  let img=document.getElementById("img"+x).src;
  let price=document.getElementById('price'+x).textContent;
  let name=document.getElementById("name"+x).innerText;
  let quantity=document.getElementById("quantity"+x).value;

  var oldquan;

  if(!(document.body.contains(document.getElementById("item"+x)))){ //ken l'item mesh mawjoud fel cart
    if(quantity>0 && quantity<300){ //ken l'input jawou behi
      let tr = document.createElement("tr");
      tr.setAttribute("id","item"+x); //<tr id="item"+x></tr>
      let td1 = document.createElement("td");
      let td2 = document.createElement("td");
      let td3 = document.createElement("td");

      //td class "si-pic"
      let img1=document.createElement("img");
      img1.setAttribute("width","72px");
      img1.setAttribute("height","72px");
      img1.setAttribute("src",img);
      img1.setAttribute("alt","");
      td1.appendChild(img1);
      td1.classList.add("si-pic");

      //td class "si-text"
      let div1=document.createElement("div");
      div1.classList.add("product-selected");
      //p tekhou itemxprice et itemxquantity
      let p1=document.createElement("p");
      //creating spans
      let spa1=document.createElement("span");
      spa1.setAttribute("id",'item'+x+'price');
      spa1.innerText=price;

      let spa2=document.createElement("span");
      spa2.setAttribute("id",'item'+x+'quantity');
      spa2.innerText=quantity;

      let t=document.createTextNode("DT x ")

      p1.appendChild(spa1);
      p1.append(t);
      p1.appendChild(spa2);
      //h6 tekhou nom
      let h6=document.createElement("h6");
      h6.setAttribute("id","item"+x+"name");
      h6.textContent=name;
      h6.style.color="#50cf80";
      div1.appendChild(p1);
      div1.appendChild(h6);
      td2.appendChild(div1);
      td2.classList.add("si-text");

      //td class "si-close"
      let btn1=document.createElement("button");
      btn1.setAttribute("type","button");
      btn1.classList.add("btn-close");
      btn1.setAttribute("disabled","");
      btn1.setAttribute("arialabel","Close");
      td3.appendChild(btn1);
      td3.setAttribute("onclick","sup("+x+")");
      td3.classList.add("si-close");

      //tr id "item"+x
      tr.appendChild(td1);
      tr.appendChild(td2);
      tr.appendChild(td3);
      table.appendChild(tr);

      //Ajout Cookies de l'item x
      setCookie("name"+x,name,1);
      setCookie("price"+x,price,1);
      setCookie("quantity"+x,quantity,1);

      //Ajout Quantité panier
      cartquantity.innerHTML=parseInt(cartquantity.innerHTML)+1;
      setCookie("cartquantity",parseInt(cartquantity.innerHTML),1);

      //calcul total
      let total=document.getElementById("totalprice");
      total.innerHTML=parseInt(total.innerHTML)+(parseInt(price)*parseInt(quantity));

      document.getElementById("quantity"+x).style.borderColor="#000000";
      var linkToFocus = document.querySelector('.cart-hover');
      linkToFocus.style="visibility: visible;opacity:1;top:60px;";
      
      setTimeout(function() {
        linkToFocus.style="";
      }, 1500);
    }
    else{
      document.getElementById("quantity"+x).style.borderColor="red";
    }
  }
  else{ //ken l'item deja mawjoud
    if(quantity>0 && quantity<500){
      //Ajout Cookies de l'item x
      setCookie("name"+x,name,1);
      setCookie("price"+x,price,1);

      //calcul total
      let total=document.getElementById("totalprice");
      oldquan=parseInt(getCookie("quantity"+x));
      quantity= parseInt(quantity) + parseInt(getCookie("quantity"+x));
      
      total.innerHTML=parseInt(total.innerHTML)-(parseInt(price)*oldquan)+(parseInt(price)*parseInt(quantity));
      document.getElementById("item"+x+"quantity").innerHTML=quantity;

      setCookie("quantity"+x,quantity,1);
      document.getElementById("quantity"+x).style.borderColor="#000000";

      var linkToFocus = document.querySelector('.cart-hover');
      linkToFocus.style="visibility: visible;opacity:1;top:60px;";
      
      setTimeout(function() {
        linkToFocus.style="";
      }, 1500);
    }
    else{
      document.getElementById("quantity"+x).style.borderColor="red";
    }
  }
}

//Cart delete element
function sup(x){
  let tbody=document.getElementById("cart-items");
  let tr=document.getElementById("item"+x);
  let price=document.getElementById("item"+x+"price").textContent;
  let quantity=document.getElementById("item"+x+"quantity").textContent;
  let total=document.getElementById("totalprice");
  let cartquantity=document.getElementById("cartquantity");

  //supp itemx
  tbody.removeChild(tr);
  setCookie("name"+x,"",0);
  setCookie("price"+x,"",0);
  setCookie("quantity"+x,"",0);

  //calcul cartquantity
  cartquantity.innerHTML=parseInt(cartquantity.innerHTML)-1;
  //calcul total
  total.innerHTML=parseInt(total.innerHTML)-(parseInt(price)*parseInt(quantity));
  if (cartquantity.innerHTML>0){
    setCookie("cartquantity",parseInt(cartquantity.innerHTML),1);
  }
  else{
    setCookie("cartquantity","",0);
  }
  location.reload();
}

//Checkout page validation
function validateCheckout() {
  //nom prenom
  var nom =  document.getElementById('nom').value;
  if (nom == "") {
      document.querySelector('.status').innerText = "Veuillez remplir votre nom!";
      document.getElementById('nom').style.borderColor='red';
      return false;
  }
  else{
    document.getElementById('nom').style.borderColor='#ebebeb';
  }
  var prenom =  document.getElementById('prenom').value;
  if (prenom == "") {
      document.querySelector('.status').innerText = "Veuillez remplir votre prenom!";
      document.getElementById('prenom').style.borderColor='red';
      return false;
  }
  else{
    document.getElementById('prenom').style.borderColor='#ebebeb';
  }
  //email
  var email =  document.getElementById('email').value;
  if (email == "") {
      document.querySelector('.status').innerText = "Veuillez remplir votre email!";
      document.getElementById('email').style.borderColor='red';
      return false;
  } else {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      if(!re.test(email)){
          document.querySelector('.status').innerText = "Format d'email invalide!";
          document.getElementById('email').style.borderColor='red';
          return false;
      }
      document.getElementById('email').style.borderColor='#ebebeb';
  }
  
  //phone
  var phone =  document.getElementById('phone').value;
  if (phone == "") {
    document.querySelector('.status').innerText = "Veuillez mettre votre numero de téléphone!";
    document.getElementById('phone').style.borderColor='red';
    return false;
  }
  if (phone.toString().length != 8 ) {
    document.querySelector('.status').innerText = "Veuillez vérifier votre numero de téléphone!";
    document.getElementById('phone').style.borderColor='red';
    return false;
  }
  else{
    document.getElementById('phone').style.borderColor='#ebebeb';
  }
  //ville
  var ville =  document.getElementById('ville').value;
  if (ville == "") {
    document.querySelector('.status').innerText = "Veuillez remplir votre ville!";
    document.getElementById('ville').style.borderColor='red';
    return false;
  }
  else{
    document.getElementById('ville').style.borderColor='#ebebeb';
  }
  //address
  var address =  document.getElementById('address').value;
  if (address == "") {
      document.querySelector('.status').innerText = "Veuillez remplir votre adresse!";
      document.getElementById('address').style.borderColor='red';
      return false;
  }
  else{
    document.getElementById('address').style.borderColor='#ebebeb';
  }
  //zip
  var zip =  document.getElementById('zip').value;
  if (zip == "") {
      document.querySelector('.status').innerText = "Veuillez remplir votre code postale!";
      document.getElementById('zip').style.borderColor='red';
      return false;
  }
  if (zip.toString().length != 4) {
    document.querySelector('.status').innerText = "Veuillez vérifier votre code postale!";
    document.getElementById('zip').style.borderColor='red';
    return false;
  }
  else{
    document.getElementById('zip').style.borderColor='#ebebeb';
  }
  document.querySelector('.status').innerText = "Envoi...";

  $.ajax({
      type: 'POST',
      url: 'checkout.php',
      data: {nom: nom,prenom: prenom,email: email,phone: phone,ville: ville,address: address,zip: zip},
      success: function(data){
        document.querySelector('.status').innerText = "Envoyé!";
        setCookie('post','1',5/(24*60));
        location.assign('merci.php');
      },
      error: function(data){
        document.querySelector('.status').innerText = "Erreur d'envoi.";
      }
    });
}

//Contact page validation
function validateForm() {
  var name =  document.getElementById('name').value;
  if (name == "") {
      document.querySelector('.status').innerText = "Veuillez remplir votre nom";
      document.getElementById('name').style.borderColor='red';
      return false;
  }
  else{
    document.getElementById('name').style.borderColor='#ebebeb';
  }
  var email =  document.getElementById('email').value;
  if (email == "") {
      document.querySelector('.status').innerText = "Veuillez remplir votre email";
      document.getElementById('email').style.borderColor='red';
      return false;
  } else {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      if(!re.test(email)){
          document.querySelector('.status').innerText = "Format d'email invalide";
          document.getElementById('email').style.borderColor='red';
          return false;
      }
      document.getElementById('email').style.borderColor='#ebebeb';
  }
  var subject =  document.getElementById('subject').value;
  if (subject == "") {
      document.querySelector('.status').innerText = "Veuillez remplir le sujet";
      document.getElementById('subject').style.borderColor='red';
      return false;
  }
  else{
    document.getElementById('subject').style.borderColor='#ebebeb';
  }
  var tel =  document.getElementById('tel').value;
  if (tel == "") {
    document.querySelector('.status').innerText = "Veuillez mettre votre numero de téléphone";
    document.getElementById('tel').style.borderColor='red';
    return false;
  }
  if (tel.toString().length != 8 ) {
    document.querySelector('.status').innerText = "Veuillez vérifier votre numero de téléphone";
    document.getElementById('tel').style.borderColor='red';
    return false;
  }
  else{
    document.getElementById('tel').style.borderColor='#ebebeb';
  }
  var message =  document.getElementById('message').value;
  if (message == "") {
      document.querySelector('.status').innerText = "Veuillez remplir le message";
      document.getElementById('message').style.borderColor='red';
      return false;
  }
  else{
    document.getElementById('message').style.borderColor='#ebebeb';
  }
  document.querySelector('.status').innerText = "Envoi...";

  $.ajax({
      type: 'POST',
      url: 'sendem.php',
      data: {name: name,email: email,tel: tel,subject: subject,message: message},
      success: function(data){
        document.querySelector('.status').innerText = "Envoyé!";
        location.assign('merci.php');
      },
      error: function(data){
        document.querySelector('.status').innerText = "Erreur d'envoi.";
      }
    });
}

(function() {
  "use strict";
  //produits popup image
  $(document).ready(function() {
                      var popup_btn = $('.popup-btn');
                      popup_btn.magnificPopup({
                        type : 'image',
                        gallery : {
                          enabled : true
                          }
                        });
  var all_panels = $('.templatemo-accordion > li > ul').hide();

  $('.templatemo-accordion > li > a').click(function() {
      console.log('Hello world!');
      var target =  $(this).next();
      if(!target.hasClass('active')){
          all_panels.removeClass('active').slideUp();
          target.addClass('active').slideDown();
      }
    return false;
  });
  // End accordion
  });

  var mw = window.matchMedia("(max-width: 992px)");
  if (mw.matches) { // If media query matches
    document.getElementById('search').hidden=true;
    document.getElementById('searchbtn').hidden=true;
    document.getElementById('searchbtnmob').hidden=false;
  } else {
    document.getElementById('search').hidden=false;
    document.getElementById('searchbtn').hidden=false;
    document.getElementById('searchbtnmob').hidden=true;
  }
  
  window.addEventListener('resize',function(){
    if (mw.matches) { // If media query matches
      if(! document.getElementById("pop").classList.contains('popup-box-on'))
        document.getElementById('search').hidden=true;
      document.getElementById('searchbtn').hidden=true;
      document.getElementById('searchbtnmob').hidden=false;
    } else {
      if(! document.getElementById("pop").classList.contains('popup-box-on'))
        document.getElementById('search').hidden=false;
      document.getElementById('searchbtn').hidden=false;
      document.getElementById('searchbtnmob').hidden=true;
    }
    let elems = document.querySelector('.elements');
    let wid = document.getElementById('search').clientWidth;
    elems.style="visibility: hidden !important;opacity: 0;width:"+wid+"px;";
  });

  const searchbtnmob = document.getElementById("searchbtnmob");
  const popup = document.getElementById("pop");
    document.addEventListener("click", (event) => {
        const clickIn = searchbtnmob.contains(event.target);

        if (clickIn) {
          if (mw.matches) {
            popup.classList.add('popup-box-on');
            document.getElementById('search').hidden=false;
            document.getElementById('removeClass').hidden=false;
          }
          else {
            document.getElementById('search').hidden=true;
            document.getElementById('removeClass').hidden=true;
          }
        }
    });
  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    let selectEl = select(el, all)
    if (selectEl) {
      if (all) {
        selectEl.forEach(e => e.addEventListener(type, listener))
      } else {
        selectEl.addEventListener(type, listener)
      }
    }
  }

  /**
   * Easy on scroll event listener
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Back to top button
   */
  let backtotop = select('.back-to-top')
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add('active')
      } else {
        backtotop.classList.remove('active')
      }
    }
    window.addEventListener('load', toggleBacktotop)
    onscroll(document, toggleBacktotop)
  }

  /**
   * Preloader
   */
  let preloader = select('#preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      preloader.remove()
    });
  }

  /**
   * Animation on scroll
   */
  window.addEventListener('load', () => {
    AOS.init({
      duration: 1000,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    })
  });

  /**
   * Mobile nav toggle
   */
   on('click', '.mobile-nav-toggle', function(e) {
    select('#navbar').classList.toggle('navbar-mobile')
    this.classList.toggle('bi-list')
    this.classList.toggle('bi-x')
  })

  /**
   * Mobile nav dropdowns activate
   */
  on('click', '.navbar .dropdown > a', function(e) {
    if (select('#navbar').classList.contains('navbar-mobile')) {
      e.preventDefault()
      this.nextElementSibling.classList.toggle('dropdown-active')
    }
  }, true)

})()