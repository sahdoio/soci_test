/*
  Display the number of stars for the rating.
  All ratings should be up to 5, and this should
  always display 5 stars.
  Example: A rating of 2.5
  shows 2 full stars, one half star, and 2 empty stars.
*/

// Font awesome stars
const fullStar = "<i class='fas fa-star'></i>";
const halfStar = "<i class='fas fa-star-half-alt'></i>";
const emptyStar = "<i class='far fa-star'></i>";

const displayStars = rating => {
  // Empty container to append stars to
  const container = $("<div class='rating_container'></div>");
  container.append(`Rating is: ${rating}<br>`);

  // Write your code here
  for (let i = 1; i <= 5; i++) {
    var diff = i - rating    
    if (diff > 0 && diff < 1) {
      container.append(halfStar)
    } else if (diff > 0) {    
      container.append(emptyStar)
    } else {     
      container.append(fullStar)
    }
  } 
  // End

  $('.test_container').append(container);
};


for (let i = 0; i < 5; i++) {
  const rating = (Math.floor(Math.random() * 10 + 1)) * 5 / 10;
  displayStars(rating);
}