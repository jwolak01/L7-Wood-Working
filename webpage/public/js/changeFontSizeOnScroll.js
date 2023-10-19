const homePageTitle = document.querySelector('#homePageTitle');
const homePageOptions = document.querySelector('#homePageOptions');

window.addEventListener('scroll', () => {
    const current = window.scrollY;
    console.log(current)
    if (window.innerWidth > 1023) {
        if (current > 125) {
            homePageTitle.style.transition = '500ms';
            homePageTitle.style.marginTop = "-20vh";
            homePageTitle.style.marginLeft = "-10%";

            homePageOptions.style.fontSize = '20px';
            homePageOptions.style.transition = '500ms';


        } else {
            homePageTitle.style.transition = '500ms';
            homePageTitle.style.marginTop = "0vh";
            homePageTitle.style.marginLeft = "0vh";

            homePageOptions.style.fontSize = '23px';
            homePageOptions.style.transition = '500ms';

        }
    }
});
