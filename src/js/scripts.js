//require( './_checkout_steps' );
import autosize from 'autosize';
window.autosize = autosize;

document.addEventListener("DOMContentLoaded", function() {
  autosize(document.getElementById("address"));
});
