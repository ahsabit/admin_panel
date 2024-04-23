var campBtn = document.querySelector('.campaign');
var addCampaign = document.querySelector('.add-campaign');
var closeBtn = document.querySelector('.cross');

campBtn.addEventListener('click', () => {
    addCampaign.style.display = "flex";
});

closeBtn.addEventListener('click', () => {
    addCampaign.style.display = "none";
});