<?php
session_start();
require("Connect.php"); // Make sure this line is correct

try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch blog data from the database
    $stmt = $pdo->prepare("SELECT * FROM posted_blogs");
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo "No blogs found.";
    }
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posted Blogs</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="PostedBlogsStyleSheet.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo-container">
                <a href ='index.php'>
                    <img class="company-logo" src="2.jpeg" alt="Company Logo">
                </a>
                <div class="company-name">Addition</div>
                <i class="user-logo fas fa-user" onclick="toggleProfilePopup()"></i>
            </div>
        </div>
        <div class="navbar">
            <div class="navbar-left">
                <ul>
                    <li><a href="AboutUs.php" class = "AboutUs">About Us</a></li>
                    <li><a href="index.php" class = "Askforhelp"><i class="fa fa-home"></i>Home</a></li>
                    <li><a class = "Askforhelp" href="ADDPOST.php" ><i class="fa fa-paper-plane"></i>Add to this world!</a></li>
                    
                </ul>
            </div>
            <div class="navbar-right">
                <!-- Search Bar -->
                <div class="search-bar">
                    <button class="search-button" type="button"><i class="fas fa-search search-icon"></i></button>
                    <input type="text" class="search-input" placeholder="Search...">
                </div>
            </div>
        </div>
        
        <div class="main-content">
        </div>
        <button id="prevButton" style="display: none;">Previous</button>
        <button id="nextButton" style="display: none;">Next</button>
      
    </div>
        </div>
        
        <div class="footer">
            <p>Contact us: Phone: +962 778656985 | Email: 21210006@htu.edu.jo</p>
        </div>
        <div class="profile-popup" id="profilePopup">
            <h5>Profile Menu</h5>
            <ul>
                <li><a href="Profile.php">profile</a></li>
                <li><a href="Login.php">Login</a></li>
                <li><a href="Logout.php">Logout</a></li>
                
            </ul>
        </div>
    </div>    

    <script>
        
    let currentPage = 1;
    const blogsPerPage = 2;
    let totalBlogs = <?php echo count($blogs); ?>;

    function displayBlogs() {
        const blogs = <?php echo json_encode($blogs); ?>;
        const startIndex = (currentPage - 1) * blogsPerPage;
        const endIndex = startIndex + blogsPerPage;

        const mainContent = document.querySelector('.main-content');
        mainContent.innerHTML = '';
        
        for (let i = startIndex; i < endIndex && i < blogs.length; i++) {
            console.log(i);
            const blog = blogs[i];
            const blogElement = createBlogElement(blog);
            mainContent.appendChild(blogElement);
        }

        const prevButton = document.getElementById('prevButton');
        const nextButton = document.getElementById('nextButton');

        prevButton.style.display = currentPage > 1 ? 'block' : 'none';
        nextButton.style.display = endIndex < totalBlogs ? 'block' : 'none';
    }



    
    let isEditing = false;
    // Function to toggle edit mode
    function toggleEdit(id) {
        const blogDiv = document.getElementById('blogDiv' + id);
        const textarea = blogDiv.querySelector('#textarea'+id);
        textarea.removeAttribute('readonly'); // Enable editing
        isEditing = true; // Set the editing flag
        // Hide "Edit" and show "Save"
        blogDiv.querySelector('a[onclick="toggleEdit(' + id + ')"]').style.display = 'none';
        blogDiv.querySelector('a[onclick="saveEdit(' + id + ')"]').style.display = 'inline';
    }

    // Function to save edits
    function saveEdit(id) {
    const blogDiv = document.getElementById('blogDiv' + id);
    const textarea = blogDiv.querySelector('#textarea' + id);
    const updatedContent = textarea.value; // Get the updated content

    fetch('save_updated_content.php', {
        method: 'POST',
        body: new URLSearchParams({
            id: id,
            content: updatedContent,
        }),
        //The 'Content-Type': 'application/x-www-form-urlencoded' header is used in HTTP requests to specify the type of data that is being sent in the request body. 
        // In this case, it indicates that the data is formatted as URL-encoded key-value pairs, which is a common format for sending data in HTML forms.
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        // Handle success (HTTP status 200)
        isEditing = false; // Reset the editing flag
        // Hide "Save" and show "Edit"
        blogDiv.querySelector('a[onclick="saveEdit(' + id + ')"]').style.display = 'none';
        blogDiv.querySelector('a[onclick="toggleEdit(' + id + ')"]').style.display = 'inline';
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
function deleteBlog(id,blogDiv) {
    
    fetch('delete_blog.php', {
        method: 'POST',
        body: new URLSearchParams({ id: id }), //se
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
    })
    .then(response => {
        if (!response.ok) {
            
            throw new Error('Network response was not ok');
        }
        
        // Handle success (HTTP status 200)
        const blogDiv = document.getElementById('blogDiv' + id);
        console.log(blogDiv);
        if (blogDiv) {
            
            blogDiv.remove(); // Remove the blogDiv from the webpage
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}



    function createBlogElement(blog) {
        const blogDiv = document.createElement('div');
        blogDiv.classList.add('blog');
    // Define a variable to track whether the blog is in edit mode
    blogDiv.id = `blogDiv${blog['ID']}`;
        blogDiv.innerHTML = `
            <h2  
                style="   
                background-color: #BFADA3; 
                color: #1E2126; 
                text-align: center;
                ">${blog['ID']}
            </h2>
            <textarea 
                id="textarea${blog['ID']}"
                style="  
                width: 100%;
                height: 75%;
                padding: 1%;
                font-size: 20px;
                background-color: #D9D9D9;
                border: none;
                color: #1E2126; 
                text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); 
                font-family: Tangerine; 
                resize: none;
                outline: none;
                font-weight: 500;"
                ${isEditing ? '' : 'readonly'}
                // Disable textarea in view mode
                >${blog['Content']}
                </textarea>
                <div class="actions">
                    <a href="#" 
                        id="editButton${blog['ID']}"
                        style="
                            font-size: 14px;
                            color: #1E2126;
                            padding: 5px 10px; 
                            display: ${isEditing ? 'none' : 'inline'}" // Show in view mode
                            onclick="toggleEdit(${blog['ID']})"
                    >Edit</a>
                    <a href="#" 
                    style="
                        font-size: 14px;
                        color: #1E2126;
                        padding: 5px 10px; 
                        display: ${isEditing ? 'inline' : 'none'}" // Show in edit mode
                    onclick="saveEdit(${blog['ID']})" // Call saveEdit function on click
                    >Save</a>
                    <a href="#" 
                        id="deleteButton${blog['ID']}"
                        style=" 
                            font-size: 14px;
                            color: #1E2126;
                            padding: 5px 10px; 
                        "
                        onclick="deleteBlog(${blog['ID']})"
                    >Delete</a>
                </div>
            `;
        

        // Determine if the user is the author and toggle buttons accordingly
       

        const currentUserId = <?php echo json_encode($_SESSION['ID']); ?>;
        const isAuthor = currentUserId === blog['Client_ID'];
        function toggleEditButtons(id, isAuthor) {
        const editButton = blogDiv.querySelector('#editButton'+id);
        const deleteButton = blogDiv.querySelector('#deleteButton'+id);
        
        if (isAuthor) {
        } else {
            editButton.style.display = 'none';
            deleteButton.style.display = 'none';
        }
    }
        toggleEditButtons(blog['ID'], isAuthor);


    

    return blogDiv;
}



    const prevButton = document.getElementById('prevButton');
    const nextButton = document.getElementById('nextButton');

    prevButton.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            displayBlogs();
        }
    });

    nextButton.addEventListener('click', () => {
        const maxPages = Math.ceil(totalBlogs / blogsPerPage);
        if (currentPage < maxPages) {
            currentPage++;
            displayBlogs();
        }
    });

    displayBlogs();



        // Function to toggle the visibility of the profile popup
        function toggleProfilePopup() {
            const profilePopup = document.getElementById("profilePopup"); // Get the profile popup element
            if (profilePopup.style.display === "none" || profilePopup.style.display === "") {
                profilePopup.style.display = "block"; // Show the profile popup
            } else {
                profilePopup.style.display = "none"; // Hide the profile popup
            }
        }

        // Close the profile popup if the user clicks outside of it
        window.addEventListener("click", function(event) {
            const profilePopup = document.getElementById("profilePopup"); // Get the profile popup element
            if (event.target !== profilePopup && !profilePopup.contains(event.target) && event.target !== document.querySelector('.user-logo')) {
                profilePopup.style.display = "none"; // Hide the profile popup when clicking outside
            }
        });
    </script>
</body>
</html>