<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle profile button clicks
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('view-profile-btn')) {
            e.preventDefault();
            const button = e.target;
            const userId = button.dataset.userId;
            
            // Show loading state
            const originalContent = button.innerHTML;
            button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
            
            // Fetch user profile
            fetch(`/dashboard/ajax/user_profile/${userId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const user = data.data;
                        
                        // Create popover content
                        const popoverContent = `
                            <div style="text-align: center;">
                                <img src="/uploads/users/pictures/${user.userPicture || 'default-user.jpg'}" 
                                     class="user-profile-img" 
                                     alt="${user.userFullName}">
                                <h5>${user.userFullName}</h5>
                                <p>${user.userPosition}</p>
                            </div>
                            <div class="user-profile-info">
                                <div><strong>Email:</strong> ${user.userEmail}</div>
                                <div><strong>Phone:</strong> ${user.userPhone}</div>
                                <div><strong>Branch:</strong> ${user.branchName}</div>
                                <div class="divider"></div>
                                <div><strong>Account Type:</strong> ${user.userAccountType}</div>
                                <div><strong>Status:</strong> ${user.userAccountActiveStatus === '1' ? 'Active' : 'Inactive'}</div>
                                <div><strong>Created:</strong> ${new Date(user.userDateCreated).toLocaleDateString()}</div>
                            </div>
                        `;
                        
                        // Initialize or update popover (Bootstrap 4.6.0 way)
                        const popover = $(button).data('bs.popover');
                        if (popover) {
                            $(button).attr('data-content', popoverContent);
                            $(button).popover('show');
                        } else {
                            $(button).popover({
                                html: true,
                                content: popoverContent,
                                trigger: 'manual',
                                container: 'body',
                                placement: 'auto',
                                template: '<div class="popover user-profile-popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
                            }).popover('show');
                        }
                    } else {
                        alert('Failed to load user profile');
                    }
                })
                .catch(error => {
                    console.error('Error fetching user profile:', error);
                    alert('Error loading profile');
                })
                .finally(() => {
                    // Restore button content
                    button.innerHTML = originalContent;
                });
        }
        
        // Close popovers when clicking outside
        if (!e.target.hasAttribute('data-toggle') && !e.target.closest('[data-toggle="popover"]')) {
            $('[data-toggle="popover"]').popover('hide');
        }
    });
});
</script>