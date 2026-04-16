document.addEventListener('DOMContentLoaded', function() {
    initializeBookmarkButtons();
    initializeLikeButtons();
    loadBookmarkStates();
    loadLikeStates();
    loadLikeCount();
});

// Event delegation for remove bookmark button
document.addEventListener('click', function(e) {
    const btn = e.target.closest('.remove-bookmark-btn');

    if (!btn) return;

    console.log('REMOVE CLICKED');

    const type = btn.dataset.type;
    const itemId = btn.dataset.id;

    btn.disabled = true;
    btn.classList.add('opacity-60');
    const originalText = btn.textContent;
    btn.textContent = 'Removing...';

    fetch('/favorites', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken(),
        },
        body: JSON.stringify({
            type: type,
            item_id: parseInt(itemId)
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            showNotification(data.message, 'success');
            btn.closest('.bookmark-card').remove();
        } else {
            showNotification(data.message, 'error');
            btn.disabled = false;
            btn.classList.remove('opacity-60');
            btn.textContent = originalText;
        }
    })
    .catch(err => {
        showNotification('An error occurred. Please try again.', 'error');
        console.error('Error:', err);
        btn.disabled = false;
        btn.classList.remove('opacity-60');
        btn.textContent = originalText;
    });
});

function showNotification(message, type = 'info') {
    const colors = {
        success: 'bg-green-100 text-green-800',
        error: 'bg-red-100 text-red-800',
        info: 'bg-blue-100 text-blue-800'
    };

    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg ${colors[type]} shadow-lg z-50 animate-fade-in`;
    notification.textContent = message;

    document.body.appendChild(notification);
    setTimeout(() => notification.remove(), 4000);
}

function initializeBookmarkButtons() {
    document.querySelectorAll('.bookmark-btn').forEach(btn => {
        btn.addEventListener('click', toggleBookmark);
    });
}

function initializeLikeButtons() {
    document.querySelectorAll('.like-btn').forEach(btn => {
        btn.addEventListener('click', toggleLike);
    });
}

function toggleBookmark(e) {
    e.preventDefault();
    const btn = e.currentTarget;
    const type = btn.dataset.type;
    const itemId = btn.dataset.itemId;
    const isBookmarked = btn.classList.contains('bookmarked');

    btn.disabled = true;
    btn.classList.add('opacity-60');
    const originalText = btn.querySelector('.bookmark-text').textContent;
    btn.querySelector('.bookmark-text').textContent = 'Loading...';

    const method = isBookmarked ? 'DELETE' : 'POST';

    fetch('/favorites', {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken(),
        },
        body: JSON.stringify({ type: type, item_id: parseInt(itemId) })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            btn.classList.toggle('bookmarked');
            btn.classList.toggle('bg-blue-600');
            btn.classList.toggle('text-white');
            btn.classList.toggle('border-blue-600');
            btn.classList.toggle('text-blue-600');
            const text = btn.querySelector('.bookmark-text');
            text.textContent = btn.classList.contains('bookmarked') ? 'Bookmarked' : 'Bookmark';
            showNotification(data.message, 'success');
        } else {
            showNotification(data.message, 'error');
            btn.querySelector('.bookmark-text').textContent = originalText;
        }
    })
    .catch(err => {
        showNotification('An error occurred. Please try again.', 'error');
        console.error('Error:', err);
        btn.querySelector('.bookmark-text').textContent = originalText;
    })
    .finally(() => {
        btn.disabled = false;
        btn.classList.remove('opacity-60');
    });
}

function toggleLike(e) {
    e.preventDefault();
    const btn = e.currentTarget;
    const actionId = btn.dataset.actionId;
    const isLiked = btn.classList.contains('liked');

    btn.disabled = true;
    btn.classList.add('opacity-60');
    const originalText = btn.querySelector('.like-text').textContent;
    btn.querySelector('.like-text').textContent = 'Loading...';

    const method = isLiked ? 'DELETE' : 'POST';

    fetch('/likes', {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken(),
        },
        body: JSON.stringify({ action_id: parseInt(actionId) })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            btn.classList.toggle('liked');
            btn.classList.toggle('bg-red-600');
            btn.classList.toggle('hover:bg-red-700');
            btn.classList.toggle('bg-blue-600');
            btn.classList.toggle('hover:bg-blue-700');
            const likeIcon = btn.querySelector('.like-icon');
            likeIcon.textContent = btn.classList.contains('liked') ? '❤️' : '🤍';
            const text = btn.querySelector('.like-text');
            text.textContent = btn.classList.contains('liked') ? 'Unlike' : 'Like';
            updateLikeCount(data.data.like_count);
            showNotification(data.message, 'success');
        } else {
            showNotification(data.message, 'error');
            btn.querySelector('.like-text').textContent = originalText;
        }
    })
    .catch(err => {
        showNotification('An error occurred. Please try again.', 'error');
        console.error('Error:', err);
        btn.querySelector('.like-text').textContent = originalText;
    })
    .finally(() => {
        btn.disabled = false;
        btn.classList.remove('opacity-60');
    });
}

function loadLikeCount() {
    const likeBtn = document.querySelector('.like-btn');
    if (likeBtn) {
        const actionId = likeBtn.dataset.actionId;
        fetch(`/likes/${actionId}/count`)
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    updateLikeCount(data.data.like_count);
                }
            })
            .catch(err => console.error('Error:', err));
    }
}

function updateLikeCount(count) {
    const countElement = document.querySelector('.like-count .count');
    if (countElement) {
        countElement.textContent = count;
    }
}

function loadBookmarkStates() {
    document.querySelectorAll('.bookmark-btn').forEach(btn => {
        const type = btn.dataset.type;
        const itemId = btn.dataset.itemId;

        fetch('/favorites', {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': getCsrfToken(),
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success' && Array.isArray(data.data)) {
                const isBookmarked = data.data.some(fav => fav.type === type && fav.item_id === parseInt(itemId));
                if (isBookmarked) {
                    btn.classList.add('bookmarked', 'bg-blue-600', 'text-white', 'border-blue-600');
                    btn.classList.remove('text-blue-600');
                    const text = btn.querySelector('.bookmark-text');
                    if (text) text.textContent = 'Bookmarked';
                }
            }
        })
        .catch(err => console.error('Error loading bookmark state:', err));
    });
}

function loadLikeStates() {
    document.querySelectorAll('.like-btn').forEach(btn => {
        const actionId = btn.dataset.actionId;

        fetch('/likes', {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': getCsrfToken(),
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success' && data.data) {
                const isLiked = data.data.some(like => like.action_id === parseInt(actionId));
                if (isLiked) {
                    btn.classList.add('liked', 'bg-red-600', 'hover:bg-red-700');
                    btn.classList.remove('bg-blue-600', 'hover:bg-blue-700');
                    const likeIcon = btn.querySelector('.like-icon');
                    if (likeIcon) likeIcon.textContent = '❤️';
                    const text = btn.querySelector('.like-text');
                    if (text) text.textContent = 'Unlike';
                }
            }
        })
        .catch(err => console.error('Error loading like state:', err));
    });
}

function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]')?.content || '';
}
