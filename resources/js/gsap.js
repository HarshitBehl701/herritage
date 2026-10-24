import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);


/* gsap setup start */

const reduceMotion = window.matchMedia(
    "(prefers-reduced-motion: reduce)"
).matches;

/* gsap setup end */


/* hero banner animation start */

if (!reduceMotion) {

    const heroBanners = document.querySelectorAll(
        ".hero-banner, .mobile-banner"
    );

    heroBanners.forEach((heroBanner) => {

        const animateHeroContent = () => {

            const activeSlide = heroBanner.querySelector(
                ".swiper-slide-active"
            );

            if (!activeSlide) return;

            const content = activeSlide.querySelector(
                ".hero-banner-content, .mobile-banner-content"
            );

            if (!content) return;

            const eyebrow = content.querySelector(
                ".hero-banner-eyebrow, .mobile-banner-eyebrow"
            );

            const title = content.querySelector("h1");

            const description = content.querySelector("p");

            const features = content.querySelectorAll(
                ".hero-banner-features > span, .mobile-banner-features > span"
            );

            const actions = content.querySelector(
                ".hero-banner-actions, .mobile-banner-actions"
            );

            /* reset */

            gsap.killTweensOf([
                eyebrow,
                title,
                description,
                features,
                actions
            ]);

            gsap.set(eyebrow,{
                opacity:0,
                y:20
            });

            gsap.set(title,{
                opacity:1,
                yPercent:110,
                clipPath:"inset(0 0 100% 0)"
            });

            gsap.set(description,{
                opacity:1,
                yPercent:110,
                clipPath:"inset(0 0 100% 0)"
            });

            gsap.set(features,{
                opacity:0,
                y:20
            });

            gsap.set(actions,{
                opacity:0,
                y:20
            });

            /* animation timeline */

            const timeline = gsap.timeline({
                defaults:{
                    ease:"power4.out"
                }
            });

            /* eyebrow */

            timeline.to(eyebrow,{
                opacity:1,
                y:0,
                duration:0.6
            });

            /* heading mask */

            timeline.to(title,{
                yPercent:0,
                clipPath:"inset(0 0 0% 0)",
                duration:1.05,
                ease:"power4.out"
            },"-=0.25");

            /* paragraph mask */

            timeline.to(description,{
                yPercent:0,
                clipPath:"inset(0 0 0% 0)",
                duration:0.9,
                ease:"power4.out"
            },"-=0.65");

            /* features */

            timeline.to(features,{
                opacity:1,
                y:0,
                duration:0.55,
                stagger:0.08,
                ease:"power3.out"
            },"-=0.4");

            /* actions */

            timeline.to(actions,{
                opacity:1,
                y:0,
                duration:0.65,
                ease:"power3.out"
            },"-=0.3");
        };

        /* initial slide */

        animateHeroContent();

        /* swiper slide change */

        const swiperWrapper = heroBanner.querySelector(
            ".swiper-wrapper"
        );

        if (swiperWrapper) {

            const observer = new MutationObserver(() => {
                animateHeroContent();
            });

            observer.observe(swiperWrapper,{
                subtree:true,
                attributes:true,
                attributeFilter:["class"]
            });
        }
    });
}

/* hero banner animation end */


/* about section animation start */

if (!reduceMotion) {

    const aboutSections = document.querySelectorAll(
        ".about-section"
    );

    aboutSections.forEach((section) => {

        /* content */

        const content = section.querySelector(
            ".about-content"
        );

        /* visual */

        const visual = section.querySelector(
            ".about-visual"
        );

        if (!content || !visual) return;


        /* content elements */

        const heading = content.querySelector(
            ".about-heading"
        );

        const title = content.querySelector(
            "h2"
        );

        const intro = content.querySelector(
            ".about-intro"
        );

        const paragraphs = content.querySelectorAll(
            ":scope > p:not(.about-intro)"
        );

        const stats = content.querySelectorAll(
            ".about-stat"
        );

        const actions = content.querySelector(
            ".about-actions"
        );


        /* visual elements */

        const image = visual.querySelector(
            ".about-image"
        );

        const imageLabel = visual.querySelector(
            ".about-image-label"
        );

        const card = visual.querySelector(
            ".about-card"
        );

        const verticalText = visual.querySelector(
            ".about-vertical-text"
        );

        const goldLine = visual.querySelector(
            ".about-gold-line"
        );


        /* initial content state */

        gsap.set(heading,{
            opacity:0,
            y:15
        });

        gsap.set(title,{
            opacity:0,
            y:30
        });

        gsap.set(intro,{
            opacity:0,
            y:20
        });

        gsap.set(paragraphs,{
            opacity:0,
            y:18
        });

        gsap.set(stats,{
            opacity:0,
            y:15
        });

        gsap.set(actions,{
            opacity:0,
            y:12
        });


        /* initial image mask */

        gsap.set(image,{
            opacity:1,
            scale:1.02,
            clipPath:"inset(0 100% 0 0)"
        });


        /* visual elements */

        gsap.set(imageLabel,{
            opacity:0,
            y:8
        });

        gsap.set(card,{
            opacity:0,
            x:12,
            y:8
        });

        gsap.set(verticalText,{
            opacity:0,
            x:8
        });

        gsap.set(goldLine,{
            scaleY:0,
            transformOrigin:"top center"
        });


        /* reset about */

        const resetAbout = () => {

            gsap.killTweensOf([
                heading,
                title,
                intro,
                paragraphs,
                stats,
                actions,
                image,
                imageLabel,
                card,
                verticalText,
                goldLine
            ]);


            /* content reset */

            gsap.set(heading,{
                opacity:0,
                y:15
            });

            gsap.set(title,{
                opacity:0,
                y:30
            });

            gsap.set(intro,{
                opacity:0,
                y:20
            });

            gsap.set(paragraphs,{
                opacity:0,
                y:18
            });

            gsap.set(stats,{
                opacity:0,
                y:15
            });

            gsap.set(actions,{
                opacity:0,
                y:12
            });


            /* image reset */

            gsap.set(image,{
                opacity:1,
                scale:1.02,
                clipPath:"inset(0 100% 0 0)"
            });


            /* visual reset */

            gsap.set(imageLabel,{
                opacity:0,
                y:8
            });

            gsap.set(card,{
                opacity:0,
                x:12,
                y:8
            });

            gsap.set(verticalText,{
                opacity:0,
                x:8
            });

            gsap.set(goldLine,{
                scaleY:0,
                transformOrigin:"top center"
            });
        };


        /* play about animation */

        const playAbout = () => {

            resetAbout();


            const timeline = gsap.timeline({
                defaults:{
                    ease:"power3.out"
                }
            });


            /* heading + image start */

            timeline.to(heading,{
                opacity:1,
                y:0,
                duration:0.5,
                ease:"power3.out"
            });


            /* image starts with heading */

            timeline.to(image,{
                clipPath:"inset(0 0% 0 0)",
                scale:1,
                duration:0.8,
                ease:"power3.out"
            },"<");


            /* title */

            timeline.to(title,{
                opacity:1,
                y:0,
                duration:0.6,
                ease:"power4.out"
            },"-=0.3");


            /* intro */

            timeline.to(intro,{
                opacity:1,
                y:0,
                duration:0.5
            },"-=0.3");


            /* paragraphs */

            timeline.to(paragraphs,{
                opacity:1,
                y:0,
                duration:0.45,
                stagger:0.07
            },"-=0.2");


            /* stats */

            timeline.to(stats,{
                opacity:1,
                y:0,
                duration:0.4,
                stagger:0.07
            },"-=0.2");


            /* button */

            timeline.to(actions,{
                opacity:1,
                y:0,
                duration:0.45
            },"-=0.2");


            /* image label */

            timeline.to(imageLabel,{
                opacity:1,
                y:0,
                duration:0.4
            },"-=0.5");


            /* floating card */

            timeline.to(card,{
                opacity:1,
                x:0,
                y:0,
                duration:0.45
            },"-=0.3");


            /* vertical text */

            timeline.to(verticalText,{
                opacity:1,
                x:0,
                duration:0.4
            },"-=0.25");


            /* gold line */

            timeline.to(goldLine,{
                scaleY:1,
                duration:0.5,
                ease:"power2.out"
            },"-=0.3");
        };


        /* initial reset */

        resetAbout();


        /* scroll trigger */

        ScrollTrigger.create({

            trigger:section,

            start:"top 82%",

            end:"bottom 18%",

            onEnter:() => {
                playAbout();
            },

            onEnterBack:() => {
                playAbout();
            },

            onLeave:() => {
                resetAbout();
            },

            onLeaveBack:() => {
                resetAbout();
            }

        });

    });
}

/* about section animation end */


/* collections section animation start */

if (!reduceMotion) {

    const collectionsSections = document.querySelectorAll(
        ".collections-section"
    );

    collectionsSections.forEach((section) => {

        const eyebrow = section.querySelector(
            ".collections-eyebrow"
        );

        const title = section.querySelector(
            ".collections-heading h2"
        );

        const headingRight = section.querySelector(
            ".collections-heading-right"
        );

        const cards = section.querySelectorAll(
            ".collections-grid > .collection-card"
        );

        const bottom = section.querySelector(
            ".collections-bottom"
        );

        if (!cards.length) return;


        /* initial state */

        gsap.set(eyebrow,{
            opacity:0,
            y:15
        });

        gsap.set(title,{
            opacity:0,
            y:25
        });

        gsap.set(headingRight,{
            opacity:0,
            y:20
        });

        gsap.set(cards,{
            opacity:0,
            y:35,
            scale:0.98
        });

        gsap.set(bottom,{
            opacity:0,
            y:15
        });


        /* reset collections */

        const resetCollections = () => {

            gsap.killTweensOf([
                eyebrow,
                title,
                headingRight,
                cards,
                bottom
            ]);

            gsap.set(eyebrow,{
                opacity:0,
                y:15
            });

            gsap.set(title,{
                opacity:0,
                y:25
            });

            gsap.set(headingRight,{
                opacity:0,
                y:20
            });

            gsap.set(cards,{
                opacity:0,
                y:35,
                scale:0.98
            });

            gsap.set(bottom,{
                opacity:0,
                y:15
            });
        };


        /* play collections animation */

        const playCollections = () => {

            resetCollections();


            const timeline = gsap.timeline({
                defaults:{
                    ease:"power3.out"
                }
            });


            /* eyebrow */

            timeline.to(eyebrow,{
                opacity:1,
                y:0,
                duration:0.45
            });


            /* title */

            timeline.to(title,{
                opacity:1,
                y:0,
                duration:0.6,
                ease:"power4.out"
            },"-=0.25");


            /* right content */

            timeline.to(headingRight,{
                opacity:1,
                y:0,
                duration:0.55
            },"-=0.4");


            /* collection cards */

            timeline.to(cards,{
                opacity:1,
                y:0,
                scale:1,
                duration:0.65,
                stagger:0.1,
                ease:"power3.out"
            },"-=0.25");


            /* bottom */

            timeline.to(bottom,{
                opacity:1,
                y:0,
                duration:0.45
            },"-=0.3");
        };


        /* initial reset */

        resetCollections();


        /* scroll trigger */

        ScrollTrigger.create({

            trigger:section,

            start:"top 80%",

            end:"bottom 20%",

            onEnter:() => {
                playCollections();
            },

            onEnterBack:() => {
                playCollections();
            },

            onLeave:() => {
                resetCollections();
            },

            onLeaveBack:() => {
                resetCollections();
            }

        });

    });
}

/* collections section animation end */

/* why broga section animation start */

if (!reduceMotion) {

    const whyBrogaSections = document.querySelectorAll(
        ".why-broga-section"
    );

    whyBrogaSections.forEach((section) => {

        const eyebrow = section.querySelector(
            ".why-broga-eyebrow"
        );

        const title = section.querySelector(
            ".why-broga-heading h2"
        );

        const description = section.querySelector(
            ".why-broga-heading > p"
        );

        const features = section.querySelectorAll(
            ".why-broga-features > .why-broga-feature"
        );

        const icons = section.querySelectorAll(
            ".why-broga-feature > .why-broga-icon"
        );

        const featureContents = section.querySelectorAll(
            ".why-broga-feature > .why-broga-content"
        );

        const bottom = section.querySelector(
            ".why-broga-bottom"
        );

        if (!features.length) return;


        /* initial state */

        gsap.set(eyebrow,{
            opacity:0,
            y:12
        });

        gsap.set(title,{
            opacity:0,
            y:25
        });

        gsap.set(description,{
            opacity:0,
            y:15
        });

        gsap.set(features,{
            opacity:0,
            y:25
        });

        gsap.set(icons,{
            opacity:0,
            scale:0.9
        });

        gsap.set(featureContents,{
            opacity:0,
            y:10
        });

        gsap.set(bottom,{
            opacity:0,
            y:12
        });


        /* reset */

        const resetWhyBroga = () => {

            gsap.killTweensOf([
                eyebrow,
                title,
                description,
                features,
                icons,
                featureContents,
                bottom
            ]);


            /* heading reset */

            gsap.set(eyebrow,{
                opacity:0,
                y:12
            });

            gsap.set(title,{
                opacity:0,
                y:25
            });

            gsap.set(description,{
                opacity:0,
                y:15
            });


            /* features reset */

            gsap.set(features,{
                opacity:0,
                y:25
            });

            gsap.set(icons,{
                opacity:0,
                scale:0.9
            });

            gsap.set(featureContents,{
                opacity:0,
                y:10
            });


            /* bottom reset */

            gsap.set(bottom,{
                opacity:0,
                y:12
            });
        };


        /* play animation */

        const playWhyBroga = () => {

            resetWhyBroga();


            const timeline = gsap.timeline({
                defaults:{
                    ease:"power3.out"
                }
            });


            /* eyebrow */

            timeline.to(eyebrow,{
                opacity:1,
                y:0,
                duration:0.3
            });


            /* title */

            timeline.to(title,{
                opacity:1,
                y:0,
                duration:0.45,
                ease:"power4.out"
            },"-=0.18");


            /* description */

            timeline.to(description,{
                opacity:1,
                y:0,
                duration:0.35
            },"-=0.2");


            /* feature cards */

            timeline.to(features,{
                opacity:1,
                y:0,
                duration:0.4,
                stagger:0.06,
                ease:"power3.out"
            },"-=0.15");


            /* icons */

            timeline.to(icons,{
                opacity:1,
                scale:1,
                duration:0.35,
                stagger:0.06,
                ease:"back.out(1.2)"
            },"-=0.32");


            /* feature content */

            timeline.to(featureContents,{
                opacity:1,
                y:0,
                duration:0.35,
                stagger:0.06
            },"-=0.3");


            /* bottom */

            timeline.to(bottom,{
                opacity:1,
                y:0,
                duration:0.35
            },"-=0.2");

        };


        /* initial reset */

        resetWhyBroga();


        /* scroll trigger */

        ScrollTrigger.create({

            trigger:section,

            start:"top 90%",

            end:"bottom 10%",

            onEnter:() => {
                playWhyBroga();
            },

            onEnterBack:() => {
                playWhyBroga();
            },

            onLeave:() => {
                resetWhyBroga();
            },

            onLeaveBack:() => {
                resetWhyBroga();
            }

        });

    });
}

/* why broga section animation end */


/* featured products section animation start */

if (!reduceMotion) {

    const featuredSections = document.querySelectorAll(
        ".featured-products-section"
    );

    featuredSections.forEach((section) => {

        const eyebrow = section.querySelector(
            ".featured-products-eyebrow"
        );

        const title = section.querySelector(
            ".featured-products-heading h2"
        );

        const viewButton = section.querySelector(
            ".featured-products-view"
        );

        const slider = section.querySelector(
            ".featured-products-slider"
        );

        const slides = section.querySelectorAll(
            ".featured-products-slider > .swiper-wrapper > .swiper-slide"
        );

        const navigation = section.querySelector(
            ".featured-products-navigation"
        );

        if (!slider || !slides.length) return;


        /* initial state */

        gsap.set(eyebrow,{
            opacity:0,
            y:12
        });

        gsap.set(title,{
            opacity:0,
            y:25
        });

        gsap.set(viewButton,{
            opacity:0,
            y:15
        });

        gsap.set(slides,{
            opacity:0,
            y:30,
            scale:0.98
        });

        gsap.set(navigation,{
            opacity:0,
            y:12
        });


        /* reset */

        const resetFeatured = () => {

            gsap.killTweensOf([
                eyebrow,
                title,
                viewButton,
                slides,
                navigation
            ]);


            /* heading reset */

            gsap.set(eyebrow,{
                opacity:0,
                y:12
            });

            gsap.set(title,{
                opacity:0,
                y:25
            });

            gsap.set(viewButton,{
                opacity:0,
                y:15
            });


            /* slides reset */

            gsap.set(slides,{
                opacity:0,
                y:30,
                scale:0.98
            });


            /* navigation reset */

            gsap.set(navigation,{
                opacity:0,
                y:12
            });
        };


        /* play featured animation */

        const playFeatured = () => {

            resetFeatured();


            const timeline = gsap.timeline({
                defaults:{
                    ease:"power3.out"
                }
            });


            /* eyebrow */

            timeline.to(eyebrow,{
                opacity:1,
                y:0,
                duration:0.3
            });


            /* title */

            timeline.to(title,{
                opacity:1,
                y:0,
                duration:0.45,
                ease:"power4.out"
            },"-=0.18");


            /* view all */

            timeline.to(viewButton,{
                opacity:1,
                y:0,
                duration:0.4
            },"-=0.35");


            /* product slides */

            timeline.to(slides,{
                opacity:1,
                y:0,
                scale:1,
                duration:0.5,
                stagger:0.07,
                ease:"power3.out"
            },"-=0.15");


            /* navigation */

            timeline.to(navigation,{
                opacity:1,
                y:0,
                duration:0.35
            },"-=0.25");

        };


        /* initial reset */

        resetFeatured();


        /* scroll trigger */

        ScrollTrigger.create({

            trigger:section,

            start:"top 90%",

            end:"bottom 10%",

            onEnter:() => {
                playFeatured();
            },

            onEnterBack:() => {
                playFeatured();
            },

            onLeave:() => {
                resetFeatured();
            },

            onLeaveBack:() => {
                resetFeatured();
            }

        });

    });
}

/* featured products section animation end */

/* brand stats section animation start */

if (!reduceMotion) {

    const brandStatsSections = document.querySelectorAll(
        ".brand-stats-section"
    );

    brandStatsSections.forEach((section) => {

        const eyebrow = section.querySelector(
            ".brand-stats-eyebrow"
        );

        const title = section.querySelector(
            ".brand-stats-heading-left h2"
        );

        const headingRight = section.querySelector(
            ".brand-stats-heading-right"
        );

        const stats = section.querySelectorAll(
            ".brand-stats-wrap > .brand-stat"
        );

        const numbers = section.querySelectorAll(
            ".brand-stat-number"
        );

        if (!stats.length) return;

        /* initial state start */

        gsap.set(eyebrow,{
            opacity:0,
            y:12
        });

        gsap.set(title,{
            opacity:0,
            y:25
        });

        gsap.set(headingRight,{
            opacity:0,
            y:20
        });

        gsap.set(stats,{
            opacity:0,
            y:30
        });

        /* initial state end */


        /* reset animation start */

        const resetBrandStats = () => {

            gsap.killTweensOf([
                eyebrow,
                title,
                headingRight,
                stats,
                numbers
            ]);

            gsap.set(eyebrow,{
                opacity:0,
                y:12
            });

            gsap.set(title,{
                opacity:0,
                y:25
            });

            gsap.set(headingRight,{
                opacity:0,
                y:20
            });

            gsap.set(stats,{
                opacity:0,
                y:30
            });

            numbers.forEach((number) => {
                number.textContent = "0";
            });
        };

        /* reset animation end */


        /* play animation start */

        const playBrandStats = () => {

            resetBrandStats();

            const timeline = gsap.timeline({
                defaults:{
                    ease:"power3.out"
                }
            });

            timeline.to(eyebrow,{
                opacity:1,
                y:0,
                duration:0.3
            });

            timeline.to(title,{
                opacity:1,
                y:0,
                duration:0.5,
                ease:"power4.out"
            },"-=0.18");

            timeline.to(headingRight,{
                opacity:1,
                y:0,
                duration:0.45
            },"-=0.35");

            timeline.to(stats,{
                opacity:1,
                y:0,
                duration:0.45,
                stagger:0.08,
                ease:"power3.out"
            },"-=0.2");


            /* number counter animation start */

            numbers.forEach((number) => {

                const target = parseInt(
                    number.dataset.count,
                    10
                );

                const counter = {
                    value:0
                };

                timeline.to(counter,{
                    value:target,
                    duration:1.1,
                    ease:"power2.out",
                    onUpdate:() => {
                        number.textContent = Math.floor(
                            counter.value
                        );
                    }
                },"-=0.35");

            });

            /* number counter animation end */

        };

        /* play animation end */


        /* scroll trigger start */

        resetBrandStats();

        ScrollTrigger.create({
            trigger:section,
            start:"top 90%",
            end:"bottom 10%",

            onEnter:() => {
                playBrandStats();
            },

            onEnterBack:() => {
                playBrandStats();
            },

            onLeave:() => {
                resetBrandStats();
            },

            onLeaveBack:() => {
                resetBrandStats();
            }
        });

        /* scroll trigger end */

    });
}

/* brand stats section animation end */


/* catalogue section animation start */

if (!reduceMotion) {

    const catalogueSections = document.querySelectorAll(
        ".catalogue-section"
    );

    catalogueSections.forEach((section) => {

        const content = section.querySelector(
            ".catalogue-content"
        );

        const eyebrow = section.querySelector(
            ".catalogue-eyebrow"
        );

        const title = section.querySelector(
            ".catalogue-content h2"
        );

        const description = section.querySelector(
            ".catalogue-content > p"
        );

        const infoItems = section.querySelectorAll(
            ".catalogue-info > .catalogue-info-item"
        );

        const actions = section.querySelector(
            ".catalogue-actions"
        );

        const visual = section.querySelector(
            ".catalogue-visual"
        );

        const image = section.querySelector(
            ".catalogue-image"
        );

        const imageElement = section.querySelector(
            ".catalogue-image > img"
        );

        const card = section.querySelector(
            ".catalogue-card"
        );

        if (!content || !visual) return;


        /* initial state start */

        gsap.set(eyebrow,{
            opacity:0,
            y:12
        });

        gsap.set(title,{
            opacity:0,
            y:25
        });

        gsap.set(description,{
            opacity:0,
            y:18
        });

        gsap.set(infoItems,{
            opacity:0,
            y:20
        });

        gsap.set(actions,{
            opacity:0,
            y:15
        });

        gsap.set(image,{
            opacity:1,
            clipPath:"inset(0 0 100% 0)"
        });

        gsap.set(imageElement,{
            scale:1.08
        });

        gsap.set(card,{
            opacity:0,
            x:25,
            y:15
        });

        /* initial state end */


        /* reset animation start */

        const resetCatalogue = () => {

            gsap.killTweensOf([
                eyebrow,
                title,
                description,
                infoItems,
                actions,
                image,
                imageElement,
                card
            ]);

            gsap.set(eyebrow,{
                opacity:0,
                y:12
            });

            gsap.set(title,{
                opacity:0,
                y:25
            });

            gsap.set(description,{
                opacity:0,
                y:18
            });

            gsap.set(infoItems,{
                opacity:0,
                y:20
            });

            gsap.set(actions,{
                opacity:0,
                y:15
            });

            gsap.set(image,{
                opacity:1,
                clipPath:"inset(0 0 100% 0)"
            });

            gsap.set(imageElement,{
                scale:1.08
            });

            gsap.set(card,{
                opacity:0,
                x:25,
                y:15
            });
        };

        /* reset animation end */


        /* play animation start */

        const playCatalogue = () => {

            resetCatalogue();

            const timeline = gsap.timeline({
                defaults:{
                    ease:"power3.out"
                }
            });


            /* content animation start */

            timeline.to(eyebrow,{
                opacity:1,
                y:0,
                duration:0.3
            });

            timeline.to(title,{
                opacity:1,
                y:0,
                duration:0.5,
                ease:"power4.out"
            },"-=0.18");

            timeline.to(description,{
                opacity:1,
                y:0,
                duration:0.4
            },"-=0.3");

            timeline.to(infoItems,{
                opacity:1,
                y:0,
                duration:0.4,
                stagger:0.07
            },"-=0.2");

            timeline.to(actions,{
                opacity:1,
                y:0,
                duration:0.4
            },"-=0.25");

            /* content animation end */


            /* visual animation start */

            timeline.to(image,{
                clipPath:"inset(0 0 0% 0)",
                duration:0.75,
                ease:"power3.out"
            },"-=0.55");

            timeline.to(imageElement,{
                scale:1,
                duration:0.9,
                ease:"power3.out"
            },"<");

            timeline.to(card,{
                opacity:1,
                x:0,
                y:0,
                duration:0.45,
                ease:"power3.out"
            },"-=0.35");

            /* visual animation end */

        };

        /* play animation end */


        /* scroll trigger start */

        resetCatalogue();

        ScrollTrigger.create({
            trigger:section,
            start:"top 90%",
            end:"bottom 10%",

            onEnter:() => {
                playCatalogue();
            },

            onEnterBack:() => {
                playCatalogue();
            },

            onLeave:() => {
                resetCatalogue();
            },

            onLeaveBack:() => {
                resetCatalogue();
            }
        });

        /* scroll trigger end */

    });
}

/* catalogue section animation end */


/* journal section animation start */

if (!reduceMotion) {

    const journalSections = document.querySelectorAll(
        ".journal-section"
    );

    journalSections.forEach((section) => {

        const eyebrow = section.querySelector(
            ".journal-eyebrow"
        );

        const title = section.querySelector(
            ".journal-heading-content h2"
        );

        const viewAll = section.querySelector(
            ".journal-view-all"
        );

        const cards = section.querySelectorAll(
            ".journal-grid > .journal-card"
        );

        const images = section.querySelectorAll(
            ".journal-card > .journal-image"
        );

        const imageElements = section.querySelectorAll(
            ".journal-card > .journal-image > img"
        );

        const contents = section.querySelectorAll(
            ".journal-card > .journal-content"
        );

        if (!cards.length) return;


        /* initial state start */

        gsap.set(eyebrow,{
            opacity:0,
            y:12
        });

        gsap.set(title,{
            opacity:0,
            y:25
        });

        gsap.set(viewAll,{
            opacity:0,
            y:15
        });

        gsap.set(cards,{
            opacity:0,
            y:35
        });

        gsap.set(images,{
            opacity:1
        });

        gsap.set(imageElements,{
            scale:1.08
        });

        gsap.set(contents,{
            opacity:0,
            y:15
        });

        /* initial state end */


        /* reset animation start */

        const resetJournal = () => {

            gsap.killTweensOf([
                eyebrow,
                title,
                viewAll,
                cards,
                imageElements,
                contents
            ]);

            gsap.set(eyebrow,{
                opacity:0,
                y:12
            });

            gsap.set(title,{
                opacity:0,
                y:25
            });

            gsap.set(viewAll,{
                opacity:0,
                y:15
            });

            gsap.set(cards,{
                opacity:0,
                y:35
            });

            gsap.set(imageElements,{
                scale:1.08
            });

            gsap.set(contents,{
                opacity:0,
                y:15
            });
        };

        /* reset animation end */


        /* play animation start */

        const playJournal = () => {

            resetJournal();

            const timeline = gsap.timeline({
                defaults:{
                    ease:"power3.out"
                }
            });


            /* heading animation start */

            timeline.to(eyebrow,{
                opacity:1,
                y:0,
                duration:0.3
            });

            timeline.to(title,{
                opacity:1,
                y:0,
                duration:0.5,
                ease:"power4.out"
            },"-=0.18");

            timeline.to(viewAll,{
                opacity:1,
                y:0,
                duration:0.4
            },"-=0.35");

            /* heading animation end */


            /* cards animation start */

            timeline.to(cards,{
                opacity:1,
                y:0,
                duration:0.5,
                stagger:0.09,
                ease:"power3.out"
            },"-=0.15");

            timeline.to(imageElements,{
                scale:1,
                duration:0.7,
                stagger:0.09,
                ease:"power3.out"
            },"<");

            timeline.to(contents,{
                opacity:1,
                y:0,
                duration:0.4,
                stagger:0.09,
                ease:"power3.out"
            },"-=0.35");

            /* cards animation end */

        };

        /* play animation end */


        /* scroll trigger start */

        resetJournal();

        ScrollTrigger.create({
            trigger:section,
            start:"top 90%",
            end:"bottom 10%",

            onEnter:() => {
                playJournal();
            },

            onEnterBack:() => {
                playJournal();
            },

            onLeave:() => {
                resetJournal();
            },

            onLeaveBack:() => {
                resetJournal();
            }
        });

        /* scroll trigger end */

    });
}

/* journal section animation end */


/* enquiry cta section animation start */

if (!reduceMotion) {

    const enquirySections = document.querySelectorAll(
        ".enquiry-cta-section"
    );

    enquirySections.forEach((section) => {

        const content = section.querySelector(
            ".enquiry-cta-content"
        );

        const eyebrow = section.querySelector(
            ".enquiry-cta-eyebrow"
        );

        const title = section.querySelector(
            ".enquiry-cta-content h2"
        );

        const description = section.querySelector(
            ".enquiry-cta-content > p"
        );

        const button = section.querySelector(
            ".enquiry-cta-btn"
        );

        const details = section.querySelectorAll(
            ".enquiry-cta-details > .enquiry-cta-detail"
        );

        if (!content || !details.length) return;


        /* initial state start */

        gsap.set(eyebrow,{
            opacity:0,
            y:12
        });

        gsap.set(title,{
            opacity:0,
            y:30
        });

        gsap.set(description,{
            opacity:0,
            y:18
        });

        gsap.set(button,{
            opacity:0,
            y:15
        });

        gsap.set(details,{
            opacity:0,
            x:30
        });

        /* initial state end */


        /* reset animation start */

        const resetEnquiry = () => {

            gsap.killTweensOf([
                eyebrow,
                title,
                description,
                button,
                details
            ]);

            gsap.set(eyebrow,{
                opacity:0,
                y:12
            });

            gsap.set(title,{
                opacity:0,
                y:30
            });

            gsap.set(description,{
                opacity:0,
                y:18
            });

            gsap.set(button,{
                opacity:0,
                y:15
            });

            gsap.set(details,{
                opacity:0,
                x:30
            });
        };

        /* reset animation end */


        /* play animation start */

        const playEnquiry = () => {

            resetEnquiry();

            const timeline = gsap.timeline({
                defaults:{
                    ease:"power3.out"
                }
            });


            /* content animation start */

            timeline.to(eyebrow,{
                opacity:1,
                y:0,
                duration:0.3
            });

            timeline.to(title,{
                opacity:1,
                y:0,
                duration:0.55,
                ease:"power4.out"
            },"-=0.18");

            timeline.to(description,{
                opacity:1,
                y:0,
                duration:0.4
            },"-=0.3");

            timeline.to(button,{
                opacity:1,
                y:0,
                duration:0.45
            },"-=0.25");

            /* content animation end */


            /* details animation start */

            timeline.to(details,{
                opacity:1,
                x:0,
                duration:0.45,
                stagger:0.1,
                ease:"power3.out"
            },"-=0.35");

            /* details animation end */

        };

        /* play animation end */


        /* scroll trigger start */

        resetEnquiry();

        ScrollTrigger.create({
            trigger:section,
            start:"top 90%",
            end:"bottom 10%",

            onEnter:() => {
                playEnquiry();
            },

            onEnterBack:() => {
                playEnquiry();
            },

            onLeave:() => {
                resetEnquiry();
            },

            onLeaveBack:() => {
                resetEnquiry();
            }
        });

        /* scroll trigger end */

    });
}

/* enquiry cta section animation end */


/* faq section animation start */

if (!reduceMotion) {

    const faqSections = document.querySelectorAll(
        ".faq-section"
    );

    faqSections.forEach((section) => {

        const eyebrow = section.querySelector(
            ".faq-eyebrow"
        );

        const title = section.querySelector(
            ".faq-heading-content h2"
        );

        const description = section.querySelector(
            ".faq-heading > p"
        );

        const faqItems = section.querySelectorAll(
            ".faq-wrap > .faq-item"
        );

        if (!faqItems.length) return;


        /* initial state start */

        gsap.set(eyebrow,{
            opacity:0,
            y:12
        });

        gsap.set(title,{
            opacity:0,
            y:25
        });

        gsap.set(description,{
            opacity:0,
            y:18
        });

        gsap.set(faqItems,{
            opacity:0,
            y:25
        });

        /* initial state end */


        /* reset animation start */

        const resetFaq = () => {

            gsap.killTweensOf([
                eyebrow,
                title,
                description,
                faqItems
            ]);

            gsap.set(eyebrow,{
                opacity:0,
                y:12
            });

            gsap.set(title,{
                opacity:0,
                y:25
            });

            gsap.set(description,{
                opacity:0,
                y:18
            });

            gsap.set(faqItems,{
                opacity:0,
                y:25
            });
        };

        /* reset animation end */


        /* play animation start */

        const playFaq = () => {

            resetFaq();

            const timeline = gsap.timeline({
                defaults:{
                    ease:"power3.out"
                }
            });


            /* heading animation start */

            timeline.to(eyebrow,{
                opacity:1,
                y:0,
                duration:0.3
            });

            timeline.to(title,{
                opacity:1,
                y:0,
                duration:0.5,
                ease:"power4.out"
            },"-=0.18");

            timeline.to(description,{
                opacity:1,
                y:0,
                duration:0.4
            },"-=0.3");

            /* heading animation end */


            /* faq items animation start */

            timeline.to(faqItems,{
                opacity:1,
                y:0,
                duration:0.45,
                stagger:0.08,
                ease:"power3.out"
            },"-=0.2");

            /* faq items animation end */

        };

        /* play animation end */


        /* scroll trigger start */

        resetFaq();

        ScrollTrigger.create({
            trigger:section,
            start:"top 90%",
            end:"bottom 10%",

            onEnter:() => {
                playFaq();
            },

            onEnterBack:() => {
                playFaq();
            },

            onLeave:() => {
                resetFaq();
            },

            onLeaveBack:() => {
                resetFaq();
            }
        });

        /* scroll trigger end */

    });
}

/* faq section animation end */


/* contact strip section animation start */

if (!reduceMotion) {

    const contactSections = document.querySelectorAll(
        ".contact-strip-section"
    );

    contactSections.forEach((section) => {

        const heading = section.querySelector(
            ".contact-strip-heading"
        );

        const eyebrow = section.querySelector(
            ".contact-strip-eyebrow"
        );

        const title = section.querySelector(
            ".contact-strip-heading h2"
        );

        const contactItems = section.querySelectorAll(
            ".contact-strip-details > .contact-strip-item"
        );

        const button = section.querySelector(
            ".contact-strip-button"
        );

        const icons = section.querySelectorAll(
            ".contact-strip-item > .contact-strip-icon"
        );

        if (!heading || !contactItems.length) return;


        /* initial state start */

        gsap.set(eyebrow,{
            opacity:0,
            y:12
        });

        gsap.set(title,{
            opacity:0,
            y:25
        });

        gsap.set(contactItems,{
            opacity:0,
            x:25
        });

        gsap.set(button,{
            opacity:0,
            x:25
        });

        gsap.set(icons,{
            opacity:0,
            scale:0.85
        });

        /* initial state end */


        /* reset animation start */

        const resetContact = () => {

            gsap.killTweensOf([
                eyebrow,
                title,
                contactItems,
                button,
                icons
            ]);

            gsap.set(eyebrow,{
                opacity:0,
                y:12
            });

            gsap.set(title,{
                opacity:0,
                y:25
            });

            gsap.set(contactItems,{
                opacity:0,
                x:25
            });

            gsap.set(button,{
                opacity:0,
                x:25
            });

            gsap.set(icons,{
                opacity:0,
                scale:0.85
            });
        };

        /* reset animation end */


        /* play animation start */

        const playContact = () => {

            resetContact();

            const timeline = gsap.timeline({
                defaults:{
                    ease:"power3.out"
                }
            });


            /* heading animation start */

            timeline.to(eyebrow,{
                opacity:1,
                y:0,
                duration:0.3
            });

            timeline.to(title,{
                opacity:1,
                y:0,
                duration:0.5,
                ease:"power4.out"
            },"-=0.18");

            /* heading animation end */


            /* contact items animation start */

            timeline.to(contactItems,{
                opacity:1,
                x:0,
                duration:0.45,
                stagger:0.1
            },"-=0.2");

            timeline.to(icons,{
                opacity:1,
                scale:1,
                duration:0.35,
                stagger:0.1,
                ease:"back.out(1.2)"
            },"-=0.35");

            /* contact items animation end */


            /* button animation start */

            timeline.to(button,{
                opacity:1,
                x:0,
                duration:0.45
            },"-=0.25");

            /* button animation end */

        };

        /* play animation end */


        /* scroll trigger start */

        resetContact();

        ScrollTrigger.create({
            trigger:section,
            start:"top 90%",
            end:"bottom 10%",

            onEnter:() => {
                playContact();
            },

            onEnterBack:() => {
                playContact();
            },

            onLeave:() => {
                resetContact();
            },

            onLeaveBack:() => {
                resetContact();
            }
        });

        /* scroll trigger end */

    });
}

/* contact strip section animation end */

/* collections page animation start */

if (!reduceMotion) {

    const collectionsSection = document.querySelector(
        ".collections-page-section"
    );

    if (collectionsSection) {

        /* heading animation */
        const heading = collectionsSection.querySelector(
            ".collections-page-heading"
        );

        if (heading) {

            gsap.set(heading, {
                opacity:0,
                y:30
            });

            ScrollTrigger.create({

                trigger:heading,

                start:"top 85%",
                end:"bottom 15%",

                onEnter:() => {
                    gsap.to(heading,{
                        opacity:1,
                        y:0,
                        duration:0.6,
                        ease:"power3.out"
                    });
                },

                onEnterBack:() => {
                    gsap.to(heading,{
                        opacity:1,
                        y:0,
                        duration:0.6,
                        ease:"power3.out"
                    });
                },

                onLeave:() => {
                    gsap.set(heading,{
                        opacity:0,
                        y:30
                    });
                },

                onLeaveBack:() => {
                    gsap.set(heading,{
                        opacity:0,
                        y:30
                    });
                }

            });

        }


        /* every product row */
        const rows = collectionsSection.querySelectorAll(
            ".row"
        );

        rows.forEach((row) => {

            const cards = row.querySelectorAll(
                ".collection-page-card"
            );

            if (!cards.length) return;

            gsap.set(cards,{
                opacity:0,
                y:35
            });

            ScrollTrigger.create({

                trigger:row,

                start:"top 85%",
                end:"bottom 15%",

                onEnter:() => {

                    gsap.to(cards,{
                        opacity:1,
                        y:0,
                        duration:0.55,
                        stagger:0.08,
                        ease:"power3.out"
                    });

                },

                onEnterBack:() => {

                    gsap.to(cards,{
                        opacity:1,
                        y:0,
                        duration:0.55,
                        stagger:0.08,
                        ease:"power3.out"
                    });

                },

                onLeave:() => {

                    gsap.set(cards,{
                        opacity:0,
                        y:35
                    });

                },

                onLeaveBack:() => {

                    gsap.set(cards,{
                        opacity:0,
                        y:35
                    });

                }

            });

        });


        /* seo content animation */
        const seoContent = collectionsSection.querySelector(
            ".collections-seo-content"
        );

        if (seoContent) {

            gsap.set(seoContent,{
                opacity:0,
                y:35
            });

            ScrollTrigger.create({

                trigger:seoContent,

                start:"top 85%",
                end:"bottom 15%",

                onEnter:() => {

                    gsap.to(seoContent,{
                        opacity:1,
                        y:0,
                        duration:0.6,
                        ease:"power3.out"
                    });

                },

                onEnterBack:() => {

                    gsap.to(seoContent,{
                        opacity:1,
                        y:0,
                        duration:0.6,
                        ease:"power3.out"
                    });

                },

                onLeave:() => {

                    gsap.set(seoContent,{
                        opacity:0,
                        y:35
                    });

                },

                onLeaveBack:() => {

                    gsap.set(seoContent,{
                        opacity:0,
                        y:35
                    });

                }

            });

        }

    }

}

/* collections page animation end */


/* similar products section animation start */

if (!reduceMotion) {

    const similarSections = document.querySelectorAll(
        ".similar-products-section"
    );

    similarSections.forEach((section) => {

        const heading = section.querySelector(
            ".similar-products-heading"
        );

        const products = section.querySelectorAll(
            ".similar-product-item"
        );

        if (!heading || !products.length) return;


        /* initial state */

        gsap.set(heading, {
            opacity:0,
            y:25
        });

        gsap.set(products, {
            opacity:0,
            y:35
        });


        /* reset */

        const resetSimilarProducts = () => {

            gsap.killTweensOf([
                heading,
                products
            ]);

            gsap.set(heading, {
                opacity:0,
                y:25
            });

            gsap.set(products, {
                opacity:0,
                y:35
            });

        };


        /* play animation */

        const playSimilarProducts = () => {

            resetSimilarProducts();

            const timeline = gsap.timeline({
                defaults:{
                    ease:"power3.out"
                }
            });


            /* heading */

            timeline.to(heading, {
                opacity:1,
                y:0,
                duration:0.5,
                ease:"power4.out"
            });


            /* products */

            timeline.to(products, {
                opacity:1,
                y:0,
                duration:0.5,
                stagger:0.08,
                ease:"power3.out"
            }, "-=0.2");

        };


        /* initial reset */

        resetSimilarProducts();


        /* scroll trigger */

        ScrollTrigger.create({

            trigger:section,

            start:"top 85%",

            end:"bottom 15%",

            onEnter:() => {
                playSimilarProducts();
            },

            onEnterBack:() => {
                playSimilarProducts();
            },

            onLeave:() => {
                resetSimilarProducts();
            },

            onLeaveBack:() => {
                resetSimilarProducts();
            }

        });

    });

}

/* similar products section animation end */


/* product details animation start */
if (!reduceMotion) {
    const productDetailsSections = document.querySelectorAll(".product-details-section");

    productDetailsSections.forEach((section) => {
        const image = section.querySelector(".product-image-wrap");
        const content = section.querySelector(".product-details-content");

        if (!image || !content) return;

        gsap.set(image, { opacity: 0, y: 35 });
        gsap.set(content, { opacity: 0, y: 35 });

        const resetProductDetails = () => {
            gsap.killTweensOf([image, content]);
            gsap.set(image, { opacity: 0, y: 35 });
            gsap.set(content, { opacity: 0, y: 35 });
        };

        const playProductDetails = () => {
            resetProductDetails();

            const timeline = gsap.timeline({
                defaults: {
                    ease: "power3.out"
                }
            });

            timeline.to(image, {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: "power4.out"
            });

            timeline.to(content, {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: "power3.out"
            }, "-=0.35");
        };

        resetProductDetails();

        ScrollTrigger.create({
            trigger: section,
            start: "top 85%",
            end: "bottom 15%",
            onEnter: () => {
                playProductDetails();
            },
            onEnterBack: () => {
                playProductDetails();
            },
            onLeave: () => {
                resetProductDetails();
            },
            onLeaveBack: () => {
                resetProductDetails();
            }
        });
    });
}
/* product details animation end */


/* product seo animation start */
if (!reduceMotion) {
    const seoSections = document.querySelectorAll(".product-seo-section");

    seoSections.forEach((section) => {
        const content = section.querySelector(".product-seo-content");

        if (!content) return;

        const elements = content.querySelectorAll("span, h2, h3, p, ul, ol");

        gsap.set(elements, {
            opacity: 0,
            y: 25
        });

        const resetProductSeo = () => {
            gsap.killTweensOf(elements);
            gsap.set(elements, {
                opacity: 0,
                y: 25
            });
        };

        const playProductSeo = () => {
            resetProductSeo();

            gsap.to(elements, {
                opacity: 1,
                y: 0,
                duration: 0.5,
                stagger: 0.06,
                ease: "power3.out"
            });
        };

        resetProductSeo();

        ScrollTrigger.create({
            trigger: section,
            start: "top 85%",
            end: "bottom 15%",
            onEnter: () => {
                playProductSeo();
            },
            onEnterBack: () => {
                playProductSeo();
            },
            onLeave: () => {
                resetProductSeo();
            },
            onLeaveBack: () => {
                resetProductSeo();
            }
        });
    });
}
/* product seo animation end */


/* blog page animation start */
if (!reduceMotion) {
    const blogSections = document.querySelectorAll(".blog-page-section");

    blogSections.forEach((section) => {
        const heading = section.querySelector(".blog-page-heading");
        const cards = section.querySelectorAll(".blog-page-card");

        if (!heading || !cards.length) return;

        gsap.set(heading, {
            opacity: 0,
            y: 25
        });

        gsap.set(cards, {
            opacity: 0,
            y: 35
        });

        const resetBlog = () => {
            gsap.killTweensOf([heading, cards]);

            gsap.set(heading, {
                opacity: 0,
                y: 25
            });

            gsap.set(cards, {
                opacity: 0,
                y: 35
            });
        };

        const playBlog = () => {
            resetBlog();

            const timeline = gsap.timeline({
                defaults: {
                    ease: "power3.out"
                }
            });

            timeline.to(heading, {
                opacity: 1,
                y: 0,
                duration: 0.5,
                ease: "power4.out"
            });

            timeline.to(cards, {
                opacity: 1,
                y: 0,
                duration: 0.5,
                stagger: 0.08,
                ease: "power3.out"
            }, "-=0.2");
        };

        resetBlog();

        ScrollTrigger.create({
            trigger: section,
            start: "top 85%",
            end: "bottom 15%",

            onEnter: () => {
                playBlog();
            },

            onEnterBack: () => {
                playBlog();
            },

            onLeave: () => {
                resetBlog();
            },

            onLeaveBack: () => {
                resetBlog();
            }
        });
    });
}
/* blog page animation end */


/* blog detail animation start */
if (!reduceMotion) {
    const blogDetailSections = document.querySelectorAll(".blog-detail-section");

    blogDetailSections.forEach((section) => {
        const image = section.querySelector(".blog-detail-image");
        const content = section.querySelector(".blog-detail-content");
        const contentElements = content
            ? content.querySelectorAll("h2, h3, p, ul, ol, li")
            : [];

        const sidebar = section.querySelector(".blog-detail-sidebar");
        const sidebarBoxes = sidebar
            ? sidebar.querySelectorAll(".blog-sidebar-box")
            : [];

        const sidebarElements = sidebar
            ? sidebar.querySelectorAll(".blog-sidebar-box span, .blog-sidebar-box h3, .blog-sidebar-box p, .blog-sidebar-box ul, .blog-sidebar-box li, .blog-sidebar-box a")
            : [];

        if (!image || !content || !sidebar) return;

        /* initial state */
        gsap.set(image, {
            opacity: 0,
            y: 40
        });

        gsap.set(contentElements, {
            opacity: 0,
            y: 25
        });

        gsap.set(sidebarBoxes, {
            opacity: 0,
            y: 35
        });

        gsap.set(sidebarElements, {
            opacity: 0,
            y: 20
        });

        /* reset */
        const resetBlogDetail = () => {
            gsap.killTweensOf([
                image,
                contentElements,
                sidebarBoxes,
                sidebarElements
            ]);

            gsap.set(image, {
                opacity: 0,
                y: 40
            });

            gsap.set(contentElements, {
                opacity: 0,
                y: 25
            });

            gsap.set(sidebarBoxes, {
                opacity: 0,
                y: 35
            });

            gsap.set(sidebarElements, {
                opacity: 0,
                y: 20
            });
        };

        /* play */
        const playBlogDetail = () => {
            resetBlogDetail();

            const timeline = gsap.timeline({
                defaults: {
                    ease: "power3.out"
                }
            });

            /* main image */
            timeline.to(image, {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: "power4.out"
            });

            /* blog content - one by one */
            timeline.to(contentElements, {
                opacity: 1,
                y: 0,
                duration: 0.5,
                stagger: 0.06,
                ease: "power3.out"
            }, "-=0.25");

            /* sidebar boxes */
            timeline.to(sidebarBoxes, {
                opacity: 1,
                y: 0,
                duration: 0.5,
                stagger: 0.1,
                ease: "power3.out"
            }, "-=0.25");

            /* sidebar content */
            timeline.to(sidebarElements, {
                opacity: 1,
                y: 0,
                duration: 0.4,
                stagger: 0.04,
                ease: "power3.out"
            }, "-=0.25");
        };

        /* initial reset */
        resetBlogDetail();

        /* repeat every time section enters viewport */
        ScrollTrigger.create({
            trigger: section,
            start: "top 85%",
            end: "bottom 15%",

            onEnter: () => {
                playBlogDetail();
            },

            onEnterBack: () => {
                playBlogDetail();
            },

            onLeave: () => {
                resetBlogDetail();
            },

            onLeaveBack: () => {
                resetBlogDetail();
            }
        });
    });
}
/* blog detail animation end */


