var orderBtn = document.querySelectorAll('.progress-num');
var addCampaign = document.querySelector('.add-campaign');
var closeBtn = document.querySelector('.cross');
var idField = document.getElementById('order-id');

orderBtn.forEach(orB => {
    orB.addEventListener('click', function(){
        idField.value = orB.style.zIndex;
        addCampaign.style.display = "flex";
    });
});

closeBtn.addEventListener('click', () => {
    addCampaign.style.display = "none";
});