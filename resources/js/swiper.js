/* hero slider start */
import Swiper from "swiper";

import {
    Autoplay,
    Navigation,
    Pagination,
    EffectFade
} from "swiper/modules";

import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import "swiper/css/effect-fade";


export function initHeroSlider() {

    
    // hero banner slider start
    const slider = document.querySelector(".hero-banner-swiper");

    if (slider) {
        new Swiper(slider, {
            modules: [
                Autoplay,
                Navigation,
                Pagination,
                EffectFade
            ],

            slidesPerView: 1,

            effect: "fade",

            fadeEffect: {
                crossFade: true
            },

            speed: 1200,

            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true
            },

            navigation: {
                nextEl: ".hero-banner-next",
                prevEl: ".hero-banner-prev"
            },

            pagination: {
                el: ".hero-banner-pagination",
                type: "fraction",

                formatFractionCurrent: function(number) {
                    return String(number).padStart(2, "0");
                },

                formatFractionTotal: function(number) {
                    return String(number).padStart(2, "0");
                }
            }
        });
    }
    // hero banner slider end



/* mobile banner slider start */
const mobileslider=document.querySelector(".mobile-banner-swiper");

if(mobileslider){
    const mobileSection=mobileslider.closest(".mobile-banner");
    const mobileNext=mobileSection.querySelector(".mobile-banner-next");
    const mobilePrev=mobileSection.querySelector(".mobile-banner-prev");
    const mobilePagination=mobileSection.querySelector(".mobile-banner-pagination");

    new Swiper(mobileslider,{
        modules:[
            Autoplay,
            Navigation,
            Pagination,
            EffectFade
        ],
        slidesPerView:1,
        effect:"fade",
        fadeEffect:{
            crossFade:true
        },
        speed:1200,
        autoplay:{
            delay:5000,
            disableOnInteraction:false,
            pauseOnMouseEnter:true
        },
        navigation:{
            nextEl:mobileNext,
            prevEl:mobilePrev
        },
        pagination:{
            el:mobilePagination,
            type:"fraction",
            formatFractionCurrent:function(number){
                return String(number).padStart(2,"0");
            },
            formatFractionTotal:function(number){
                return String(number).padStart(2,"0");
            }
        }
    });
}
/* mobile banner slider end */



/* products slider start */
const productsSlider = document.querySelector(".products-swiper");

if (productsSlider) {

    new Swiper(productsSlider, {

        modules: [
            Navigation,
            Pagination
        ],

        slidesPerView:1.15,
        spaceBetween:18,

        speed:800,
        grabCursor:true,

        navigation:{
            nextEl:".products-next-btn",
            prevEl:".products-prev-btn"
        },

        pagination:{
            el:".products-pagination",
            clickable:true
        },

        breakpoints:{
            576:{
                slidesPerView:2,
                spaceBetween:20
            },

            992:{
                slidesPerView:3,
                spaceBetween:24
            },

            1400:{
                slidesPerView:3.2,
                spaceBetween:28
            }
        }

    });

}
/* products slider end */


// google reviews slider start
const reviewsSlider = document.querySelector(".reviews-swiper");

if (reviewsSlider) {
    new Swiper(reviewsSlider, {
        modules: [Navigation, Pagination],

        slidesPerView: 1,
        spaceBetween: 18,

        navigation: {
            prevEl: ".reviews-prev",
            nextEl: ".reviews-next"
        },

        pagination: {
            el: ".reviews-pagination",
            clickable: true
        },

        breakpoints: {
            576: {
                slidesPerView: 2
            },
            992: {
                slidesPerView: 3
            }
        }
    });
}
// google reviews slider end


// blogs slider start
const blogsSlider = document.querySelector(".blogs-swiper");

if (blogsSlider) {
    new Swiper(blogsSlider, {
        modules:[Navigation,Pagination],
        slidesPerView:1,
        spaceBetween:20,
        navigation:{
            prevEl:".blogs-prev",
            nextEl:".blogs-next"
        },
        pagination:{
            el:".blogs-pagination",
            clickable:true
        },
        breakpoints:{
            576:{
                slidesPerView:1.2
            },
            768:{
                slidesPerView:2
            },
            992:{
                slidesPerView:3
            },
            1200:{
                slidesPerView:3
            }
        }
    });
}
// blogs slider end


/* similar slider start */

const similarSlider = document.querySelector(".similar-swiper");

if (similarSlider && !similarSlider.swiper) {

    const similarSection = similarSlider.closest(".similar-section");

    if (similarSection) {

        const similarPrev = similarSection.querySelector(".similar-prev");
        const similarNext = similarSection.querySelector(".similar-next");
        const similarPagination = similarSection.querySelector(".similar-pagination");

        new Swiper(similarSlider, {

            modules: [
                Navigation,
                Pagination
            ],

            slidesPerView: 1,
            spaceBetween: 20,
            speed: 800,
            grabCursor: true,
            watchOverflow: true,

            navigation: {
                prevEl: similarPrev,
                nextEl: similarNext
            },

            pagination: {
                el: similarPagination,
                clickable: true
            },

            breakpoints: {
                576: {
                    slidesPerView: 1.2,
                    spaceBetween: 20
                },

                768: {
                    slidesPerView: 2,
                    spaceBetween: 24
                },

                992: {
                    slidesPerView: 3,
                    spaceBetween: 24
                },

                1200: {
                    slidesPerView: 3,
                    spaceBetween: 28
                }
            }

        });

    }

}

/* similar slider end */


}
