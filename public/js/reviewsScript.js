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
    starLogo.id = `reviewRating${data.id}`
    cardBody.appendChild(starLogo);

    let text = document.createElement("p");
    text.id = `reviewText${data.id}`
    text.innerText = data.text;
    cardBody.appendChild(text);

    let image = document.createElement("img");
    image.classList.add("card-img");
    image.classList.add("text-center");
    image.id = `reviewImage${data.id}`
    image.alt = "review-image"
    cardBody.appendChild(image);

    if (data.image === null || data.image === "") {
        image.style.display = 'none';
    } else {
        image.style.display = 'block';
        image.src = data.image;
    }

    let user = document.createElement("p");
    user.classList.add("a");
    user.innerText = "Reviewed by: " + data.user_login;
    cardBody.appendChild(user);

    let date = document.createElement("p");
    date.classList.add("a");
    date.id = `reviewDate${data.id}`
    date.innerText = "On: " + data.date;
    cardBody.appendChild(date);

    let removeButt = document.createElement("button");
    removeButt.innerText = "remove";
    removeButt.classList.add("btn");
    removeButt.classList.add("add-review");
    removeButt.classList.add("remove");
    removeButt.onclick = function () {deleteReview(data)};
    cardBody.appendChild(removeButt);

    let modifyButt = document.createElement("button");
    modifyButt.innerText = "modify";
    modifyButt.classList.add("btn");
    modifyButt.classList.add("add-review");
    modifyButt.classList.add("remove");
    modifyButt.style.marginTop = "10px";
    modifyButt.onclick = function () {modifyReviewButton(data)};
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

function modifyReviewButton(data) {
    let addReviewButt = document.getElementById("add-review");
    addReviewButt.style.display = "none";
    let reviewForm = document.getElementById('review-form');
    if (reviewForm.classList.contains('hide')) {
        document.getElementById('review-form').classList.toggle('hide');
    }
    document.getElementById("add-review").focus();
    let text = document.getElementById("text");
    text.value = document.getElementById(`reviewText${data.id}`).innerText;
    let image = document.getElementById("image");
    if (document.getElementById(`reviewImage${data.id}`).src.includes("localhost")) {
        image.value = "";
    } else {
        image.value = document.getElementById(`reviewImage${data.id}`).src;
    }
    document.getElementById("reviewButton").innerText = "modify";
    document.getElementById("reviewButton").style.marginBottom = "10px";

    document.getElementById(document.getElementById(`reviewRating${data.id}`).innerText).checked = true;

    let cancelButt = document.getElementById("CancelReviewButton");
    cancelButt.style.display = "block";

    let addButton = document.getElementById("reviewButton");

    addButton.onclick = function () {modifyReview(data.id)};


}
function deleteReview(data) {
    let url = `http://localhost/?id=${id}&reviewId=${data.id}&c=item&a=deleteReview`;
    location.replace(url);
}

function addReviewButton() {
    let reviewForm = document.getElementById('review-form');
    document.getElementById('review-form').classList.toggle('hide');
    let cancelButt = document.getElementById("CancelReviewButton");
    cancelButt.style.display = "none";
}

function cleanReviewForm() {
    document.getElementById('review-form').classList.toggle('hide');
    let addReviewButt = document.getElementById("add-review");
    addReviewButt.style.display = "block";

    document.getElementById("text").value = "";
    document.getElementById("image").value = "";
    let addButton = document.getElementById("reviewButton");
    addButton.innerText = "add";
    addButton.onclick = function () {addReviewForm()};
    document.getElementById("1").checked = false;
    document.getElementById("2").checked = false;
    document.getElementById("3").checked = false;
    document.getElementById("4").checked = false;
    document.getElementById("5").checked = false;
}

function modifyReview(id) {
    let newText = document.getElementById("text").value;
    let newImage = document.getElementById("image").value;
    let stars = document.querySelectorAll('input[name="rating"]');
    let selectedRating;
    for (const star of stars) {
        if (star.checked) {
            selectedRating = star.value;
            break;
        }
    }
    console.log(id);
    let url = `http://localhost/index.php?id=${id}&text=${newText}&image=${newImage}&rating=${selectedRating}&c=item&a=modifyReview`;
    let request = new XMLHttpRequest();
    request.onload = function () {
        let data = JSON.parse(request.responseText);
        cleanReviewForm();
        let text = document.getElementById(`reviewText${data.id}`);
        text.innerText = data.text;
        let image = document.getElementById(`reviewImage${data.id}`);
        if (data.image !== null) {
            image.style.display = 'block';
            image.src = data.image;
        } else {
            image.style.display = 'none';
            image.setAttribute('src', '');
        }
        let rating = document.getElementById(`reviewRating${data.id}`);
        rating.innerText = data.stars;
        let date = document.getElementById(`reviewDate${data.id}`)
        date.innerText = "On: " + data.date;
    };
    request.open("GET", url)
    request.send();
}

function onOptionChange() {
    let addCart1 = document.getElementById("cartButton1");
    let addCart0 = document.getElementById("cartButton0");
    let colorSel = document.getElementById("colorSelect");
    let materialSel = document.getElementById("materialSelect");
    let layerSel = document.getElementById("layerSelect");

    if (colorSel.selectedIndex !== 0 && materialSel.selectedIndex !== 0 && layerSel.selectedIndex !== 0) {
        if (addCart1 !== null) {
            addCart1.style.display = 'block';
        }
        if (addCart0 !== null) {
            addCart0.style.display = 'block';
        }
    } else {
        if (addCart1 !== null) {
            addCart1.style.display = 'none';
        }
        if (addCart0 !== null) {
            addCart0.style.display = 'none';
        }
    }
}




