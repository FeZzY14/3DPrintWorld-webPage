let offset = 0;
let length = 4;
loadMoreReviews();

function loadMoreReviews() {
    let url = `http://localhost/index.php?id=${id}&offset=${offset}&length=${length}&c=item&a=loadReviews`;
    let request = new XMLHttpRequest();
    request.onload = function () {
        let data = JSON.parse(request.responseText);
        console.log(data);
        for (let i = 0; i < data.length; i++) {
            createNewCard(data[i]);
        }
        if (data.length === 0) {
            document.getElementById("loadMoreButton").style.visibility = 'hidden';
            if (offset === 4) {
                noReviews();
            }
        }
    };
    request.open("GET", url)
    request.send();
    offset += 4;
}

function createNewCard(data) {
    let reviews = document.getElementById("reviews");

    let newReview = document.createElement("div");
    newReview.classList.add("card");
    newReview.classList.add("w-auto");
    newReview.classList.add("p-3");

    let cardBody = document.createElement("div")
    cardBody.classList.add("card-body");
    newReview.appendChild(cardBody);

    let starLogo = document.createElement("i");
    starLogo.classList.add("bi");
    starLogo.classList.add("bi-star-fill");
    starLogo.classList.add("star");
    starLogo.innerText = data.stars;
    cardBody.appendChild(starLogo);

    let text = document.createElement("p");
    text.innerText = data.text;
    cardBody.appendChild(text);

    if (data.image !== null) {
        let image = document.createElement("img");
        image.classList.add("card-img");
        image.classList.add("text-center");
        image.src = data.image;
        image.alt = "review-image"
        cardBody.appendChild(image);
    }

    let user = document.createElement("p");
    user.classList.add("a");
    user.innerText = "Reviewed by: " + data.user_login;
    cardBody.appendChild(user);

    let date = document.createElement("p");
    date.classList.add("a");
    date.innerText = "On: " + data.date;
    cardBody.appendChild(date);

    reviews.insertBefore(newReview, reviews.lastElementChild);
}

function noReviews() {
    let reviews = document.getElementById("reviews");

    let newReview = document.createElement("div");
    newReview.classList.add("card");
    newReview.classList.add("w-auto");
    newReview.classList.add("p-3");
    newReview.id = "no-reviews";

    let cardBody = document.createElement("div")
    cardBody.classList.add("card-body");
    newReview.appendChild(cardBody);

    let text = document.createElement("p");
    text.classList.add("text-center");
    text.innerText = "no reviews";
    cardBody.appendChild(text);

    reviews.appendChild(newReview);
}



