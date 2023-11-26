let offset = 0;
let length = 4;
noReviews();
loadMoreReviews();
function loadMoreReviews() {
    let url = `http://localhost/index.php?id=${id}&offset=${offset}&length=${length}&c=item&a=loadReviews`;
    let request = new XMLHttpRequest();
    request.onload = function () {
        let data = JSON.parse(request.responseText);
        console.log(data);
        for (let i = 0; i < data.length; i++) {
            let reviews = document.getElementById("reviews");
            reviews.insertBefore(createNewCard(data[i]), reviews.lastElementChild);
        }
        if (data.length === 0) {
            document.getElementById("loadMoreButton").style.visibility = 'hidden';
        }
        if (data.length !== 0) {
            document.getElementById("no-reviews").style.display = 'none';
        }
        offset += data.length;
    };
    request.open("GET", url)
    request.send();
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

    let removeButt = document.createElement("button");
    removeButt.innerText = "remove";
    removeButt.classList.add("btn");
    removeButt.classList.add("add-review");
    removeButt.classList.add("remove");
    cardBody.appendChild(removeButt);

    let modifyButt = document.createElement("button");
    modifyButt.innerText = "modify";
    modifyButt.classList.add("btn");
    modifyButt.classList.add("add-review");
    modifyButt.classList.add("remove");
    modifyButt.style.marginTop = "10px";
    modifyButt.onclick = function () {modifyReview(data)};
    cardBody.appendChild(modifyButt);

    if (currUser === "") {
        modifyButt.style.display = "none";
        removeButt.style.display = "none";
    } else if (currUser === data.user_login) {
        modifyButt.style.display = "block";
        removeButt.style.display = "block";
    } else {
        modifyButt.style.display = "none";
        removeButt.style.display = "none";
    }
    return newReview;
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

    reviews.insertBefore(newReview, reviews.lastElementChild);
}


function addReviewForm() {
    let text = document.getElementById("text").value;
    let image = document.getElementById("image").value;
    let stars = document.querySelectorAll('input[name="rating"]');
    let selectedRating;
    for (const star of stars) {
        if (star.checked) {
            selectedRating = star.value;
            break;
        }
    }

    let url = `http://localhost/index.php?id=${id}&text=${text}&image=${image}&rating=${selectedRating}&c=item&a=addReview`;
    let request = new XMLHttpRequest();
    request.onload = function () {
        let data = JSON.parse(request.responseText);
        console.log(data);
        document.getElementById("no-reviews").style.display = 'none';
        document.getElementById("loadMoreButton").style.visibility = 'visible';
        document.getElementById('review-form').classList.toggle('hide');
        for (let i = 0; i < data.length; i++) {
            createNewCard(data[i]);
            let reviews = document.getElementById("reviews");
            reviews.insertBefore(createNewCard(data[i]), reviews.firstElementChild);
            offset++;
        }
    };
    request.open("GET", url)
    request.send();
}

function modifyReview(data) {
    document.getElementById('review-form').classList.toggle('hide');
    document.getElementById("add-review").focus();
    let text = document.getElementById("text");
    text.value = data.text;
    let image = document.getElementById("image");
    image.value = data.image;
}



