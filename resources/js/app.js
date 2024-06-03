import './bootstrap';
import $ from 'jquery';
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

// import '../css/style.css'

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

$( document ).on( 'ajaxSend', addLaravelCSRF );

function addLaravelCSRF( event, jqxhr, settings ) {
    jqxhr.setRequestHeader( 'X-XSRF-TOKEN', getCookie( 'XSRF-TOKEN' ) );
}

function getCookie(name) {
    function escape(s) { return s.replace(/([.*+?\^${}()|\[\]\/\\])/g, '\\$1'); };
    var match = document.cookie.match(RegExp('(?:^|;\\s*)' + escape(name) + '=([^;]*)'));
    return match ? match[1] : null;
}

function likePost() {
    $('.like-btn').on('click', function(e) {
        e.preventDefault();
        
        var $this = $(this);
        var postId = $this.data('post-id');
        var isLiked = $this.data('liked');
        var $svgPath = $this.find('svg').find('path');

        if (isLiked) {
            $svgPath.attr('fill', 'grey'); // Mengubah warna menggunakan jQuery
            $this.data('liked', false);
        } else {
            $svgPath.attr('fill', 'red'); // Mengubah warna menggunakan jQuery
            $this.data('liked', true);
        }

        // Serialize data
        var requestData = {
            _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // Include CSRF token
            postId: postId,
            liked: !isLiked
        };
        var serializedData = $.param(requestData);

        // Send AJAX request to toggle like status in the backend
        $.ajax({
            url: isLiked ? '/posts/' + postId + '/unlike' : '/posts/' + postId + '/like',
            type: 'POST', // Specify the HTTP method directly
            data: serializedData,
            success: function(response) {
                console.log(response.message);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
}

function followUser() {
    $('.follow-button').on('click', function() {
        var button = $(this);
        var userId = button.data('user-id');
        var action = button.hasClass('btn-danger') ? 'unfollow' : 'follow';
        var method = action === 'follow' ? 'POST' : 'DELETE';
        var url = action === 'follow' ? '/follow/' + userId : '/unfollow/' + userId;

        $.ajax({
            url: url,
            type: method,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (action === 'follow') {
                    button.text('Unfollow');
                    button.removeClass('btn-primary').addClass('btn-danger');
                } else {
                    button.text('Follow');
                    button.removeClass('btn-danger').addClass('btn-primary');
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });
}

document.addEventListener("DOMContentLoaded", function() {
    likePost();
    followUser();
});

document.querySelector('.modal').addEventListener('shown.bs.modal', function () {
    document.querySelector('.modal').focus();
});

document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('form').addEventListener('submit', function(event) {
        var start = document.getElementById('isOn_start').value;
        var end = document.getElementById('isOn_end').value;

        if (new Date(start) >= new Date(end)) {
            event.preventDefault();
            alert('Start Time must be earlier than End Time.');
        }
    });
});

$(document).ready(function() {
    $('#search-form').on('submit', function(e) {
        e.preventDefault();

        var searchQuery = $('input[name="search"]').val();
        $.ajax({
            url: '{{ route("dashboard") }}',
            type: 'GET',
            data: { search: searchQuery },
            success: function(response) {
                // Update the content of the posts
                $('#post-container').html(response);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});
