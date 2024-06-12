<?php include "./config/navbar.php" ?>
<?php
if (!$isUser) {
    redirect("/");
}
$generalErr = "";
$success = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $creatorId = $_SESSION['id'];
    $blogTitle = sanitizer($_POST['title']);
    $description = sanitizer($_POST['description']);
    $content = sanitizer($_POST['editorContent']);
    $category = sanitizer($_POST['category']);
    $currentDate = date("Y-m-d");
    $uploadOk = false;

    if (isset($blogTitle)  && isset($description) && isset($content) && isset($category)) {
        $randomBytes = openssl_random_pseudo_bytes(16);
        $randomId = bin2hex($randomBytes);
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($randomId . $_FILES['blogImage']['name']);
        if (move_uploaded_file($_FILES['blogImage']["tmp_name"], $target_file)) {
            $uploadOk = true;
            $sql = "INSERT INTO blogpost (title,description,content,creator,category,blogImage,created_at) VALUES ('$blogTitle','$description','$content',$creatorId,'$category','$target_file','$currentDate')";
            if (mysqli_query($conn, $sql)) {
                $success = "Blog created successfully";
            } else {
                $generalErr = "Something went wrong";
            }
        } else {
            $uploadOk = false;
            $generalErr = "Falied to upload image";
        }
    } else {
        $generalErr = "Please fill all the fields";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" category="width=device-width, initial-scale=1.0">

    <title>Create Blog</title>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <!-- Include the Quill library -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <style>
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 600px;
            overflow-y: scroll;
            height: 600px;
        }

        #avatar {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .form-container::-webkit-scrollbar {
            display: none;
        }


        #editor {
            height: 300px;
        }


        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

    <div class="form-container">
        <h2>Create a New Blog Post</h2>
        <p class="success"><?php echo $success; ?></p>
        <form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
            <p class="err"><?= $generalErr; ?></p>
            <div class="form-group">
                <label for="title">Blog Title</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="blogImage">Blog Image</label>
                <input type="file" id="blogImage" name="blogImage" accept="image/*" required>
            </div>
            <div class="form-group">
                <img src="" id="avatar">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="10" required></textarea>
            </div>
            <div class="form-group">
                <label for="editorContent">Content</label>
                <div id="editor"></div>
                <input type="hidden" name="editorContent" id="editorContent">

            </div>
            <div class="form-group">
                <select name="category" id="category">
                    <option value="mern">Mern</option>
                    <option value="frontend">Frontend</option>
                    <option value="backend">Backend</option>
                </select>
            </div>
            <button type="submit">Create Blog Post</button>
        </form>
    </div>
    <script>
        let toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'], // toggled buttons
            ['blockquote', 'code-block'],

            [{
                'header': 1
            }, {
                'header': 2
            }], // custom button values
            [{
                'list': 'ordered'
            }, {
                'list': 'bullet'
            }],
            [{
                'script': 'sub'
            }, {
                'script': 'super'
            }], // superscript/subscript
            [{
                'indent': '-1'
            }, {
                'indent': '+1'
            }], // outdent/indent
            [{
                'direction': 'rtl'
            }], // text direction

            [{
                'size': ['small', false, 'large', 'huge']
            }], // custom dropdown
            [{
                'header': [1, 2, 3, 4, 5, 6, false]
            }],

            [{
                'color': []
            }, {
                'background': []
            }], // dropdown with defaults from theme
            [{
                'font': []
            }],
            [{
                'align': []
            }],

            ['clean'] // remove formatting button
        ];


        let options = {
            modules: {
                toolbar: toolbarOptions,
            },
            theme: 'snow'
        };

        let quill = new Quill('#editor', options);

        const avatar = document.querySelector("#avatar")
        const blogImage = document.querySelector("#blogImage")

        blogImage.addEventListener("change", (e) => {
            const file = e.target.files[0];
            const url = URL.createObjectURL(file)
            avatar.src = url
        })
        document.getElementById('form').onsubmit = function() {
            var editorHtml = quill.root.innerHTML;
            document.getElementById('editorContent').value = editorHtml;
        };
    </script>

</body>

</html>