const commentsContainer = document.querySelector('.commentsContainer');
const commentForm = document.getElementById('comment-form');
const commentText = document.getElementById('comment-text');

let comments = [];

// Load existing comments from storage or initialize an empty array
if (localStorage.getItem('comments')) {
    comments = JSON.parse(localStorage.getItem('comments'));
    displayComments();
}

// Display comments in the comments container
function displayComments() {
    commentsContainer.innerHTML = '';
    comments.forEach((comment, index) => {
        const commentElement = document.createElement('div');
        commentElement.classList.add('comment');
        commentElement.innerHTML = `
            <p>${comment.text}</p>
            <div class="comment-actions">
                <button onclick="editComment(${index})">Edit</button>
                <button onclick="deleteComment(${index})">Delete</button>
            </div>
        `;
        commentsContainer.appendChild(commentElement);
    });

    // Display the edit and delete buttons for the last comment
    displayCommentButtons(comments.length - 1);
}

function displayCommentButtons(index) {
    const commentActions = document.getElementById('comment-buttons');
    commentActions.innerHTML = `
        <button onclick="editComment(${index})">Edit</button>
        <button onclick="deleteComment(${index})">Delete</button>
    `;
}


// Add new comment
commentForm.addEventListener('submit', (event) => {
    event.preventDefault();
    const text = commentText.value.trim();
    if (text !== '') {
        comments.push({ text });
        localStorage.setItem('comments', JSON.stringify(comments));
        displayComments();
        commentText.value = '';

        // Scroll to the newly added comment
        commentsContainer.scrollTop = commentsContainer.scrollHeight;
    }
});

// Edit existing comment
function editComment(index) {
    const newText = prompt('Edit your comment:', comments[index].text);
    if (newText !== null) {
        comments[index].text = newText.trim();
        localStorage.setItem('comments', JSON.stringify(comments));
        displayComments();
    }
}

// Delete existing comment
function deleteComment(index) {
    if (confirm('Are you sure you want to delete this comment?')) {
        comments.splice(index, 1);
        localStorage.setItem('comments', JSON.stringify(comments));
        displayComments();
    }
}
