
  jQuery( document ).ready( function( $ ) {
      // $() will work as an alias for jQuery() inside of this function
      "use strict";

      let headings = document.getElementsByClassName('luv-category-title');

      for ( let heading of headings ) {
        console.log(heading.firstElementChild.innerText);
        // let h2 = heading.firstElementChild.firstElementChild;
        // console.log(text.clientWidth);

        // create span element
        let width, formattedWidth;
        let text = heading.firstElementChild.innerText;
        let span = document.createElement("span");
        document.body.appendChild(span);

        span.style.height = 'auto';
        span.style.width = 'auto';
        span.style.position = 'absolute';
        span.style.whiteSpace = 'no-wrap';
        span.innerHTML = text;

        width = Math.ceil(span.clientWidth);
        formattedWidth = width + "px";

        console.log(formattedWidth);
        console.log(heading.lastElementChild);
        heading.lastElementChild.style.width = formattedWidth;
        document.body.removeChild(span);
      }
  } );
