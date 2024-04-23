// -----------------navigation tracker-----------------
var analytics = document.querySelector('.analytics');
var crm = document.querySelector('.crm');
var orders = document.querySelector('.orders');
var products = document.querySelector('.menu-product');
var job = document.querySelector('.job');
var chat = document.querySelector('.chat');
var category = document.querySelector('.category');
var identity = document.getElementById('identity').innerText;
var headerTitle = document.querySelector('.header h3');

switch (identity) {
    case 'crm':
        crm.classList.add('nav_active');
        headerTitle.innerText = "CRM";
        break;

    case 'orders':
        orders.classList.add('nav_active');
        headerTitle.innerText = "orders";
        break;

    case 'products':
        products.classList.add('nav_active');
        headerTitle.innerText = "products";
        break;

    case 'job':
        job.classList.add('nav_active');
        headerTitle.innerText = "job";
        break;

    case 'chat':
        chat.classList.add('nav_active');
        headerTitle.innerText = "chat";
        break;
    
    case 'category':
        category.classList.add('nav_active');
        headerTitle.innerText = "category";
        break;

    default:
        analytics.classList.add('nav_active');
        headerTitle.innerText = "analytics";
        break;
}

// -----------------------notification && log popping-----------------------------
var notiBtn = document.querySelector('.not-btn');
var naughtyBox = document.querySelector('.notification');
var userBtn = document.querySelector('.user-prof-logged');
var user = document.querySelector('.user-container');

notiBtn.addEventListener('click',function(){
    popping(notiBtn, 'noti-btn-active', naughtyBox);
});

userBtn.addEventListener('click', function(){
    popping(userBtn, 'user-prof-showed', user);
});

document.addEventListener('click', function(event){
    whenOtherClicked('notific', 'user-log', 'noti-btn-active', notiBtn, naughtyBox, event);
});

document.addEventListener('click', function(event){
    whenOtherClicked('user-log', 'notific', 'user-prof-showed',userBtn, user, event);
});

function whenOtherClicked(thisTargetClass, thatTargetClass, cla_s, b_tn, o_bject, event){
    if(event.target.classList.contains(thisTargetClass) && event.target.classList.contains(thatTargetClass) == false){
        return;
    }else{
        if (b_tn.classList.contains(cla_s)) {
            b_tn.classList.remove(cla_s);
            o_bject.style.display = "none";
        }
    }
}

function popping(bt_n, cl_ass, ob_ject) {
    if (bt_n.classList.contains(cl_ass)) {
        bt_n.classList.remove(cl_ass);
        ob_ject.style.display = "none";
    } else {
        bt_n.classList.add(cl_ass);
        ob_ject.style.display = "block";
    }
}

// ---------------------notification management-------------------------------------
var allBtn = document.querySelector('.noti-list li.all');
var messagesBtn = document.querySelector('.noti-list li.messages');
var alertsBtn = document.querySelector('.noti-list li.alerts');
var messages = document.querySelectorAll('.message');
var alerts = document.querySelectorAll('.alert');
var noBtn = document.querySelectorAll('.noti-list li');
var activeClass = "noti-list-active";
var hideNotiClass = "hidden-notification";

messagesBtn.addEventListener('click', function(){
    mrView(messages, messagesBtn, noBtn, alerts, activeClass, hideNotiClass);
});

alertsBtn.addEventListener('click', function(){
    mrView(alerts, alertsBtn, noBtn, messages, activeClass, hideNotiClass);
});

allBtn.addEventListener('click', function() {
    allView(allBtn, noBtn, messages, alerts, activeClass, hideNotiClass);
});

function mrView(main, bu_tton, ntiBtn, otherObj, active_class, hidden_class) {
    main.forEach(function(mainEle){
        ntiBtn.forEach(ntBtn => {
            if(ntBtn.classList.contains(active_class)){
                ntBtn.classList.remove(active_class);
            }
        });
        
        bu_tton.classList.add(active_class);
    
        if (mainEle.classList.contains(hidden_class)) {
            mainEle.classList.remove(hidden_class);
            otherObj.forEach(other => {
                other.classList.add(hidden_class);
            });
        }else{
            otherObj.forEach(other => {
                other.classList.add(hidden_class);
            });
        };
    });
};

function allView(bu_tton, ntiBtn, objOne, objTwo, active_class, hidden_class){
    
    changeClass(ntiBtn, activeClass);
    
    bu_tton.classList.add(active_class);

    changeClass(objOne, hidden_class);

    changeClass(objTwo, hidden_class);
}

function changeClass(ob, _class){
    ob.forEach(ob => {
        if(ob.classList.contains(_class)){
            ob.classList.remove(_class);
        };
    });
}