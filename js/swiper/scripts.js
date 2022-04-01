var DOMAIN_NAME = $("#domainPath").val();
var DOMAIN_LANGUAGE = $("#language").val();
const MAX_SIZE_PER_FILE = 5 * 1024 * 1024;
const MAX_SIZE_TOTAL = 100 * 1024 * 1024;

function countPagesVisited() {
    let pagesVisited = localStorage.getItem("pagesVisited");
    const pathname = window.location.pathname;
    if (!pagesVisited) {
        pagesVisited = [pathname];
        localStorage.setItem("pagesVisited", JSON.stringify(pagesVisited));
    } else {
        pagesVisited = JSON.parse(pagesVisited);
        if (!pagesVisited.includes(pathname)) {
            pagesVisited.push(pathname);
        }
        localStorage.setItem("pagesVisited", JSON.stringify(pagesVisited));
    }
}

$(document).ready(function () {
    countPagesVisited();
    const elements = {
        personalInfor: {
            error: $(
                "#personal-information > .estimation-info-title .estimation-error"
            ).get(0),
            require: $(
                "#personal-information > .estimation-info-title .estimation-info-title-required"
            ).get(0),
        },
        idea: {
            error: $("#your-idea > .estimation-info-title .estimation-error").get(0),
            require: $(
                "#your-idea > .estimation-info-title .estimation-info-title-required"
            ).get(0),
        },
        visited: {
            error: $("#got-by > .estimation-info-title .estimation-error").get(0),
            require: $(
                "#got-by > .estimation-info-title .estimation-info-title-required"
            ).get(0),
        },
        projectTypes: {
            error: $("#project-types > .estimation-info-title .estimation-error").get(
                0
            ),
            require: $(
                "#project-types > .estimation-info-title .estimation-info-title-required"
            ).get(0),
        },
        captcha: {
            error: $("#captcha > .estimation-info-title .estimation-error").get(0),
            require: $(
                "#captcha > .estimation-info-title .estimation-info-title-required"
            ).get(0),
        },
        files: {
            error: $("#attach-files .estimation-error").get(0),
        },
    };

    const errorMessages = {
        idea: {
            en: "Please enter your message",
            vi: "Vui lÃ²ng Ä‘á»ƒ láº¡i lá»i nháº¯n",
        },
        visited: {
            en: "Please enter visit recommendation",
            vi: "Vui lÃ²ng nháº­p nÆ¡i giá»›i thiá»‡u",
        },
        projectTypes: {
            en: "Please select project types",
            vi: "Vui lÃ²ng chá»n loáº¡i dá»± Ã¡n",
        },
        captcha: {
            en: "Please enter the captcha",
            vi: "Vui lÃ²ng xÃ¡c nháº­n captcha",
        },
        files: {
            en:
                "Total size must be less than 100 MB and each file must be less than 5 MB",
            vi:
                "Tá»•ng dung lÆ°á»£ng nhá» hÆ¡n 100 MB vÃ  má»—i file pháº£i cÃ³ dung lÆ°á»£ng nhá» hÆ¡n 5 MB",
        },
    };

    window.successfullCaptchaCb = function () {
        this.hideError(elements.captcha);
    };

    var ppp = 10; // Post per page
    var cat = $("#more_posts").data("category");
    var pageNumber = 1;

    function load_posts() {
        pageNumber++;
        $.ajax({
            type: "GET",
            url: DOMAIN_NAME + "/search-post.php",
            data: {cat: cat, ppp: ppp, page: pageNumber},
            success: function (data) {
                var $data = $(data);
                if ($data.length) {
                    $("#ajax-posts").append($data);
                    $("#more_posts").attr("disabled", false);
                } else {
                    $("#more_posts").attr("disabled", true);
                }
            },
        });
        return false;
    }

    $("#more_posts").on("click", function () {
        // When btn is pressed.
        $("#more_posts").attr("disabled", true); // Disable the button, temp.
        load_posts();
    });

    $(".dropdown-el").click(function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).toggleClass("expanded");
        $("#sort").attr("checked", false);
        $("#" + $(e.target).attr("for")).attr("checked", true);
    });
    $(document).click(function () {
        $(".dropdown-el").removeClass("expanded");
    });
    var modal = $("#myModal");
    var modalSuccess = $("#modalSuccess");
    if (sessionStorage.getItem("AnnouncementOnce") !== "true") {
        modal.css("display", "block");
        sessionStorage.setItem("AnnouncementOnce", "true");
    }

    $(".modal-chirsmas-content span.close img").click(function () {
        modal.css("display", "none");
    });

    $(".modal-estimation-content span.close img").click(function () {
        modalSuccess.css("display", "none");
    });

    $(".modal-chirsmas-content span.close").click(function () {
        modal.css("display", "none");
    });

    $(".modal-content span.close").click(function () {
        modal.css("display", "none");
    });

    $(".modal-estimation-content span.close").click(function () {
        modalSuccess.css("display", "none");
    });

    window.onclick = function (event) {
        // if (event.target == modal) {
        //   modal.style.display = "none";
        // }
        // if (event.target == modalSuccess)
        // {
        //   modalSuccess.style.display = "none";
        // }
    };

    setTimeout(function () {
        sessionStorage.clear();
    }, 3600000);

    $('input[type="file"').change(function () {
        validateFiles(elements.files, errorMessages.files);
    });

    $(".js-range-slider").ionRangeSlider({
        type: "double",
        grid: false,
        min: 0,
        max: 100000,
        from: 25000,
        to: 50000,
        step: 5000,
        prefix: "$",
    });
    var $root = $("html, body");
    $('a[href^="#"]').on("click", function (event) {
        event.preventDefault();
        var href = this.hash;
        $root.animate(
            {
                scrollTop: $(href).offset().top - $(".header").height(),
            },
            600
        );

        return false;
    });

    $(window).scroll(function () {
        if ($(window).scrollTop() >= 10) {
            $(".header").addClass("header-scroll");
        } else {
            $(".header").removeClass("header-scroll");
        }
    });

    // listens field focusing
    $("#estimation-form #name").on("input", function () {
        validatePersonalInfor(elements.personalInfor);
    });
    $("#estimation-form  #email").on("input", function () {
        validatePersonalInfor(elements.personalInfor);
    });
    $("#estimation-form  #phone").on("input", function () {
        validatePersonalInfor(elements.personalInfor);
    });

    $("#estimation-form input[name*='type']").click(function () {
        validateProjectTypes(elements.projectTypes, errorMessages.projectTypes);
    });

    $("#estimation-form #content").on("input", function () {
        validateIdea(elements.idea, errorMessages.idea);
    });

    $("#estimation-form input[name*='visited']").click(function () {
        validateVisited(elements.visited, errorMessages.idea);
    });

    $("#estimation-form").submit(function () {
        // reset messages
        for (const el of Object.values(elements)) {
            hideError(el);
        }

        var DOMAIN_NAME = $("#domainPath").val();

        var formData = new FormData(this);

        const isValidMap = {
            personalInfor: validatePersonalInfor(elements.personalInfor),
            projectTypes: validateProjectTypes(
                elements.projectTypes,
                errorMessages.projectTypes
            ),
            idea: validateIdea(elements.idea, errorMessages.idea),
            visited: validateVisited(elements.visited, errorMessages.visited),
            captcha: validateCaptcha(elements.captcha, errorMessages.captcha),
            files: validateFiles(elements.files, errorMessages.files),
        };
        let isValid = true;
        let elementScrollTo = null;
        for (const entry of Object.entries(isValidMap)) {
            if (!entry[1]) {
                elementScrollTo = elements[entry[0]].error;
                isValid = false;
                break;
            }
        }

        if (!isValid) {
            if (elementScrollTo) {
                $("html, body").animate(
                    {
                        scrollTop: $(elementScrollTo).offset().top - $(".header").height(),
                    },
                    600,
                    "linear"
                );
            } else {
                alert("Something went wrong. Please try again!");
            }
            return false;
        }

        $("#contact-loader").show();

        $("#btn-estimation").attr("disabled", "disabled");

        const submitEstimation = () =>
            $.ajax({
                type: "POST",
                url: DOMAIN_NAME + "/contact-estimation.php",
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                success: function (data, textStatus) {
                    $("#contact-loader").hide();
                    $(".contact-success").remove();
                    $("#btn-estimation").removeAttr("disabled");
                    if (DOMAIN_LANGUAGE === "en") {
                        if (textStatus == "success") {
                            $("#btn-estimation").removeAttr("disabled");
                            var modalSuccess = document.getElementById("modalSuccess");
                            var spanSuccess = document.getElementsByClassName("close")[0];
                            modalSuccess.style.display = "block";
                            spanSuccess.onclick = function () {
                                modalSuccess.style.display = "none";
                            };
                            window.onclick = function (event) {
                                if (event.target == modalSuccess) {
                                    modalSuccess.style.display = "none";
                                }
                            };
                        } else {
                            $("#contact-loader").after(
                                '<div class="contact-success color-red"><strong>Send Fail</strong></div>'
                            );
                        }
                    } else {
                        if (textStatus == "success") {
                            $("#btn-estimation").removeAttr("disabled");
                            var modalSuccess = document.getElementById("modalSuccess");
                            var spanSuccess = document.getElementsByClassName("close")[0];
                            modalSuccess.style.display = "block";
                            spanSuccess.onclick = function () {
                                modalSuccess.style.display = "none";
                            };
                            window.onclick = function (event) {
                                if (event.target == modalSuccess) {
                                    modalSuccess.style.display = "none";
                                }
                            };
                        } else {
                            $("#contact-loader").after(
                                '<div class="contact-success color-red"><strong>Gá»­i tháº¥t báº¡i</strong></div>'
                            );
                        }
                    }
                    setTimeout(function () {
                        $(".contact-success").remove();
                    }, 3000);

                    $(".home, .contact-success").click(function () {
                        $(".contact-success").remove();
                    });
                },
            });

        // save pages visited by client to request form
        formData.set(
            "pages_visited_json",
            localStorage.getItem("pagesVisited") || "[]"
        );

        const onSuccess = (position) => {
            formData.set("longitude", position.coords.longitude);
            formData.set("latitude", position.coords.latitude);
            submitEstimation();
        };
        const onError = () => {
            submitEstimation();
        };
        const options = {
            enableHighAccuracy: true,
        };
        navigator.geolocation.getCurrentPosition(onSuccess, onError, options);

        return false;
    });

    $("#btn-contact").click(function (e) {
        e.preventDefault();
        const validateResult = validateContact();
        const status = validateResult.status;
        if (status) {
            var isCaptchaValidated = false;
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                isCaptchaValidated = false;
                alert("Please enter the captcha!");
                return false;
            } else {
                isCaptchaValidated = true;
            }
            if (isCaptchaValidated) {
                $("#contact-loader").show();
                var datapost = $("#contact-form").serialize();
                $("#btn-contact").prop("disabled", true);
                $.ajax({
                    type: "POST",
                    url: DOMAIN_NAME + "/contact-us.php",
                    data: datapost,
                    success: function (data, textStatus) {
                        $("#contact-loader").hide();
                        $(".contact-success").remove();
                        if (DOMAIN_LANGUAGE === "en") {
                            if (textStatus === "success") {
                                $("#email").val("");
                                $("#btn-contact").removeAttr("disabled");
                                $("#contact-loader").after(
                                    '<div id ="success-message" class="contact-success color-blue"><strong>Thank you for sending your ideas!</strong></div>'
                                );
                            } else {
                                $("#contact-loader").after(
                                    '<div class="contact-success color-red"><strong>Send Fail</strong></div>'
                                );
                            }
                        } else {
                            if (textStatus === "success") {
                                $("#email").val("");
                                $("#btn-contact").removeAttr("disabled");
                                $("#contact-loader").after(
                                    '<div id ="success-message" class="contact-success color-blue"><strong>CÃ¡m Æ¡n báº¡n Ä‘Ã£ gá»­i tin nháº¯n thÃ nh cÃ´ng!</strong></div>'
                                );
                            } else {
                                $("#contact-loader").after(
                                    '<div class="contact-success color-red"><strong>Gá»­i tháº¥t báº¡i</strong></div>'
                                );
                            }
                        }
                        setTimeout(function () {
                            $(".contact-success").remove();
                        }, 3000);

                        $(".home, .contact-success").click(function () {
                            $(".contact-success").remove();
                        });
                    },
                });
                return false;
            }
            return false;
        } else {
            alert(validateResult.message);
        }
    });
    wireUpEvents();

    handleClosePopupLanguage();

    addEventMenu();

    initWOW();

    parallaxHoverAnimation();

    animateHomeBanner();

    initCarouselHomepage();

    $(".js-tab-content").each(function (index, element) {
        initMemberSlider(element);
    });
    initCategorySlider();

    tabMemberControl();

    handleColumnTechLogo();

    lazyLoadImage();
});

function hideError(element) {
    element.error && element.error.classList.add("hidden");
    element.require && element.require.classList.remove("hidden");
}

function showError(element, message) {
    element.require && element.require.classList.add("hidden");
    element.error && element.error.classList.remove("hidden");
    let msg = "";
    switch (DOMAIN_LANGUAGE) {
        case "en":
            msg = message.en;
            break;
        case "vi":
            msg = message.vi;
            break;
    }
    $(element.error).text(msg);
}

function validatePersonalInfor(element) {
    const errors = {
        name: false,
        email: false,
        phone: false,
    };

    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var email = $("#email").val();

    let isValid = true;

    // personal information
    if ($("#name").val().length < 1) {
        errors.name = true;
    }
    if (!filter.test(email)) {
        errors.email = true;
    }
    if ($("#phone").val().length < 8) {
        errors.phone = true;
    }
    let personalMsg = "";
    for (const entry of Object.entries(errors)) {
        if (!personalMsg && entry[1]) {
            personalMsg += entry[0];
            continue;
        }
        if (entry[1]) {
            personalMsg += `, ${entry[0]}`;
        }
    }

    const messageObj = {};

    if (personalMsg) {
        switch (DOMAIN_LANGUAGE) {
            case "vi": {
                personalMsg = personalMsg.replace("phone", "sá»‘ Ä‘iá»‡n thoáº¡i");
                personalMsg = personalMsg.replace("name", "tÃªn");
                messageObj.vi = `Vui lÃ²ng nháº­p ${personalMsg} cá»§a báº¡n`;
                break;
            }
            case "en": {
                messageObj.en = "Please enter your " + personalMsg;
                break;
            }
        }

        if (element.error && element.require) {
            showError(element, messageObj);
        }
        isValid = false;
    } else {
        hideError(element);
    }
    return isValid;
}

function validateProjectTypes(element, error) {
    // project types
    if ($("input[name*='type']:checked").length === 0) {
        if (element.error && element.require) {
            showError(element, error);
        }
        return false;
    } else {
        hideError(element);
        return true;
    }
}

function validateIdea(element, error) {
    // idea
    if ($("#content").val().length < 1) {
        if (element.error && element.require) {
            showError(element, error);
        }
        return false;
    } else {
        hideError(element);
        return true;
    }
}

function validateVisited(element, error) {
    // visited
    if (!$("input[name*='visited']").is(":checked")) {
        if (element.error && element.require) {
            showError(element, error);
        }
        return false;
    } else {
        hideError(element);
        return true;
    }
}

function validateCaptcha(element, error) {
    var response = grecaptcha.getResponse();
    if (response.length === 0) {
        showError(element, error);
        return false;
    } else {
        hideError(element);
        return true;
    }
}

function validateFiles(element, error) {
    const files = $('input[type="file"]').prop("files");
    let isValid = true;
    let totalSize = 0;
    const fileNames = Array.from(files).map((file) => {
        totalSize += file.size;
        if (file.size > MAX_SIZE_PER_FILE) {
            isValid = false;
            return `<span class='file-error'>${file.name}</span>`;
        }
        return file.name;
    });
    if (totalSize > MAX_SIZE_TOTAL) {
        isValid = false;
    }
    if (!isValid) {
        showError(element, error);
    } else {
        hideError(element);
    }
    let fileNamesStr = $('input[type="file"]').prop("dataset").instruction;
    if (fileNames.length) {
        fileNamesStr = `[${fileNames.length}] ${fileNames.join(", ")}`;
    }
    $("#file_name").html(fileNamesStr);

    return isValid;
}

function lazyLoadImage() {
    var el = document.querySelectorAll("img");
    var observer = lozad(el);
    observer.observe();
}

function openMenu() {
    $(".nav-bar__left-group").fadeIn(function () {
        $(".nav-bar__list a").addClass("show");
        $("body").css("overflow", "hidden");
    });
}

function closeMenu() {
    $(".nav-bar__list a").removeClass("show");
    $("body").css("overflow", "auto");
    setTimeout(function () {
        $(".nav-bar__left-group").fadeOut("slow");
    }, 800);
}

function toggleLanguage() {
    $(".dropdown-menu").toggle();
}

function addEventMenu() {
    $(".js-open-menu").on("click", openMenu);
    $(".js-close-menu").on("click", closeMenu);
    $(".language-btn").on("click", toggleLanguage);
}

function initWOW() {
    new WOW().init();
}

function parallaxHoverAnimation() {
    $(".hover-animate").on("mousemove", function (e) {
        var $this = $(this);
        var center = {
            x: $this.width() / 2,
            y: $this.height() / 2,
        };
        var currentMousePos = {
            x: e.pageX,
            y: e.pageY,
        };
        var currentPos = {
            x: currentMousePos.x - $this.offset().left,
            y: currentMousePos.y - $this.offset().top,
        };
        var distance = {
            x: currentPos.x - center.x,
            y: currentPos.y - center.y,
        };
        var imgAnimate = $this.find("img");
        $(imgAnimate).css(
            "transform",
            "translate(" +
            -distance.x / 10 +
            "px," +
            -distance.y / 10 +
            "px) " +
            "scale(" +
            1.1 +
            ")"
        );
    });
}

function handleClosePopupLanguage() {
    $(document).mouseup(function (e) {
        var $menu = $(".dropdown-menu");
        if (!$menu.is(e.target) && $menu.has(e.target).length === 0) {
            $menu.hide();
        }
    });
}

function animateHomeBanner() {
    var path = document.querySelector("#thePath");
    if (path) {
        var animate = anime({
            targets: "#thePath",
            strokeDashoffset: [anime.setDashoffset, 0],
            easing: [0.64, 0.07, 0.32, 0.93],
            duration: 3000,
            complete: function () {
                setTimeout(function () {
                    path.style.opacity = 0;
                }, 3000);
            },
        });
        var anime2 = anime({
            targets: "#image-home-banner",
            opacity: 1,
            easing: "easeInOutQuad",
            duration: 3000,
            delay: 3000,
        });
    }
}

function validateContact() {
    var email = $("#email").val();
    var name = $("#name").val();
    var content = $("#content").val();
    const visited = $("select#visit-recommendation").val();
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (name.length < 1) {
        return {status: false, message: "Please enter your name !"};
    } else if (!filter.test(email)) {
        return {status: false, message: "Invalid Email"};
    } else if (content.length < 1) {
        return {status: false, message: "Please enter your message!"};
    } else if (!visited) {
        return {
            status: false,
            message: "Please select your visit recommendation!",
        };
    } else {
        return {status: true};
    }
}



function tabMemberControl() {
    $(".js-tab").on("click", function () {
        var $this = $(this);
        var currentTabId = $this.data("value");
        $(".js-tab.active").removeClass("active");
        $this.addClass("active");

        $(".member__slide-button__wrapper.active").removeClass("active");
        $(
            '.member__slide-button__wrapper[data-value="' + currentTabId + '"]'
        ).addClass("active");
        var tabContent = $(".js-tab-content");
        $.each(tabContent, function (index, element) {
            if ($(element).data("value") == currentTabId) {
                $(element).siblings().removeClass("active");
                $(element).addClass("active");
                // initMemberSlider(element);
                changeQuoteFollowMember();
            }
        });
    });
}

function initMemberSlider(element) {
    var currentSlider = $(element);
    var currentID = currentSlider.attr("data-value");
    var totalSlide = currentSlider.find(".js-member").length;
    var loop = true;
    var centeredSlides = true;
    var slidePerView = 1;
    var needAlignCenter = false;
    if ($(window).width() >= 991) {
        slidePerView = 4;
    } else if ($(window).width() < 991 && $(window).width() >= 600) {
        slidePerView = 2;
    }
    if (totalSlide <= slidePerView) {
        loop = false;
        centeredSlides = false;
        needAlignCenter = true;
    }
    var nextBtn = $(
        '.member__slide-button__wrapper[data-value="' +
        currentID +
        '"]' +
        " .member__slide-button--next"
    );
    var prevBtn = $(
        '.member__slide-button__wrapper[data-value="' +
        currentID +
        '"]' +
        " .member__slide-button--prev"
    );

    var memberSlider = new Swiper(currentSlider, {
        slidesPerView: 4,
        centeredSlides: centeredSlides,
        loop: loop,
        observer: true,
        observeParents: true,
        slideToClickedSlide: true,
        navigation: {
            nextEl: nextBtn,
            prevEl: prevBtn,
        },
        breakpoints: {
            991: {
                slidesPerView: 2,
            },
            600: {
                slidesPerView: "auto",
                spaceBetween: 0,
                loopedSlides: totalSlide,
                slideToClickedSlide: false,
            },
        },
        on: {
            init: function () {
                if (needAlignCenter) {
                    this.$wrapperEl[0].classList.add("justify-content-center");
                }
            },
            slideChangeTransitionEnd: changeQuoteFollowMember,
            observerUpdate: function () {
                changeQuoteFollowMember();
            },
            tap: function (e) {
                if ($(window).width() < 991) {
                    $(e.target)
                        .closest(".js-member")
                        .find(".about-us-avatar")
                        .toggleClass("tapped");
                } else {
                    if (!this.params.loop) {
                        activeQuote($(e.target).closest(".js-member").data("id"));
                    }
                }
            },
        },
    });
}

function initCategorySlider() {
    var currentSlider = $(".category-blog");
    // var currentID = currentSlider.attr("data-value");
    var totalSlide = currentSlider.find(".js-cat").length;
    var loop = true;
    var centeredSlides = true;
    var slidePerView = 1;
    var needAlignCenter = false;
    var play = {deplay: 3000};
    if ($(window).width() >= 991) {
        slidePerView = 4;
    } else if ($(window).width() < 991 && $(window).width() >= 600) {
        slidePerView = 2;
    }
    if (totalSlide <= slidePerView) {
        loop = false;
        centeredSlides = false;
        needAlignCenter = true;
        play = false;
    }
    var category = new Swiper(currentSlider, {
        slidesPerView: slidePerView,
        centeredSlides: centeredSlides,
        loop: loop,
        observer: true,
        observeParents: true,
        slideToClickedSlide: true,
        autoplay: play,
        breakpoints: {
            991: {
                slidesPerView: 2,
            },
            600: {
                slidesPerView: "auto",
                spaceBetween: 0,
                loopedSlides: totalSlide,
                slideToClickedSlide: true,
            },
        },
    });
}

function changeQuoteFollowMember() {
    var $this = $(".js-tab-content.active");
    var centerSlideId = $this.find(".swiper-slide-active .js-member").data("id");

    activeQuote(centerSlideId);
    $(".about-us-avatar.tapped").removeClass("tapped");
}

function resetMemberSlideWhenNotActive() {
    var $this = $(this);
    if ($this.hasClass("active")) {
        var centerSlideId = $this
            .find(".swiper-slide-active .js-member")
            .data("id");
        $(".about-us-avatar.tapped").removeClass("tapped");
        activeQuote(centerSlideId);
    }
}

function activeQuote(id) {
    $(".js-quote.active").removeClass("active");
    $(".js-quote").each(function (index, element) {
        if ($(element).data("id") == id) {
            $(element).addClass("active");
        }
    });
}

function handleColumnTechLogo() {
    var matchMedia = [
        window.matchMedia("(min-width: 992px)"),
        window.matchMedia("(min-width: 768) and (max-width: 991px)"),
        window.matchMedia("(max-width: 767px)"),
    ];
    var column = 0;

    function handleChangeScreenSize() {
        if (matchMedia[0].matches) {
            column = 4;
        } else if (matchMedia[1].matches) {
            column = 3;
        } else if (matchMedia[2].matches) {
            column = 2;
        }
        var totalLogo = $("#tech-logo").children().length;
        if (totalLogo < column) {
            $("#tech-logo").addClass("justify-content-center");
        } else {
            $("#tech-logo").removeClass("justify-content-center");
        }
    }

    $.each(matchMedia, function (index, element) {
        handleChangeScreenSize();
        element.addListener(handleChangeScreenSize);
    });
}

var validNavigation = false;

function endSession() {
    $.ajax({
        type: "POST",
        url: DOMAIN_NAME + "/sessiondestroy.php",
    });
}

function wireUpEvents() {
    window.onbeforeunload = function () {
        if (!validNavigation) {
            endSession();
        }
    };

    $(document).bind("keypress", function (e) {
        if (e.keyCode == 116) {
            validNavigation = true;
        }
    });

    // Attach the event click for all links in the page
    $("a").bind("click", function () {
        validNavigation = true;
    });

    // Attach the event submit for all forms in the page
    $("form").bind("submit", function () {
        validNavigation = true;
    });

    // Attach the event click for all inputs in the page
    $("input[type=submit]").bind("click", function () {
        validNavigation = true;
    });
}


function initCarouselHomepage() {
    var swiper1 = new Swiper(".carousel-images", {
        loop: true,
        effect: "fade",
        fade: {crossFade: true},
        spaceBetween: 0,
        autoplay: {
            delay: 3000,
        },
        pagination: {
            el: $(".desk-project-carousel__paging"),
            clickable: true,
        },
        navigation: {
            nextEl: $(".project-carousel-next"),
            prevEl: $(".project-carousel-prev"),
        },
    });

    var swiper2 = new Swiper(".project-slider-mobile", {
        loop: true,
        effect: "fade",
        fade: {crossFade: true},
        spaceBetween: 0,
        touchRatio: 0,
        autoplay: {
            delay: 3000,
        },
        pagination: {
            el: ".project-carousel__paging",
            clickable: false,
        },
    });
    swiper1.on("slideChange", function () {
        swiper2.slideTo(this.activeIndex);
    });
    var swiper3 = new Swiper(".testimonial-images", {
        loop: true,
        slidesPerView: 5,
        centeredSlides: true,
        spaceBetween: 5,
        navigation: {
            nextEl: ".testimonial-carousel-next",
            prevEl: ".testimonial-carousel-prev",
        },
    });

    var swiper4 = new Swiper(".testimonial-content", {
        loop: true,
        slidesPerView: 1,
        centeredSlides: true,
        effect: "fade",
        fade: {crossFade: true},
        spaceBetween: 0,
        touchRatio: 0,
    });
    var swiper5 = new Swiper(".blog-images", {
        loop: true,
        slidesPerView: 1,
        centeredSlides: true,
        spaceBetween: 5,
        pagination: {
            el: ".blog-images-pagination",
            clickable: true,
        },
        breakpoints: {
            991: {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            },
        },
    });

    swiper3.on("slideChange", function () {
        swiper4.slideToLoop(this.realIndex);
        // console.log("s3 => s4");
    });

    var swiper = new Swiper(".career-slider", {
        slidesPerView: 2,
        spaceBetween: 20,
        centeredSlides: true,
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            991: {
                slidesPerView: 2,
                spaceBetween: 30,
                loop: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            },
            600: {
                slidesPerView: 1,
                spaceBetween: 10,
                loop: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            },
        },
    });

    const homeBlogsSwiper = new Swiper("#news-events .swiper-container", {
        slidesPerView: 3,
        spaceBetween: 5,
        breakpoints: {
            991: {
                slidesPerView: 2,
            },
            640: {
                slidesPerView: 1,
                spaceBetween: 0,
            },
        },
    });
}