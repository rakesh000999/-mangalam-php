<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mangalam-php</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <nav class="d-flex justify-content-between px-5 bg-primary py-3 align-items-center text-white">
        <div class="d-flex gap-4 align-items-center">
            <div>Mangalam</div>
            <div class="d-flex gap-2 bg-white align-items-center rounded px-2 py-1">
                <div class="text-dark">Icon</div>
                <input type="search" class="border-0"
                    style="outline: 0; border-top-right-radius: 6px; border-bottom-right-radius: 6px;" placeholder="Search">
            </div>
        </div>
        <div class="d-flex gap-4">
            <div>
                <span>Icon</span>
                <span>Write</span>
            </div>
            <div>
                <span>Icon</span>
            </div>
            <div>
                <span>Icon</span>
            </div>
        </div>
    </nav>

    <section class="container mx-auto mt-4">
        <?php foreach (range(1, 5) as $i) { ?>
            <div class="d-flex justify-content-between align-items-center border px-4 py-2">
                <div class="">
                    <div>Hello</div>
                    <h2>This is test title</h2>
                    <div>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Vel, accusantium.</div>
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="d-flex gap-2">
                            <div>Sep 12</div>
                            <div>441</div>
                            <div>28</div>
                        </div>
                        <div class="d-flex gap-2">
                            <div>Icon 1</div>
                            <div>Icon 2</div>
                            <div>Icon 3</div>
                        </div>
                    </div>
                </div>
                <div style="width: 200px;">
                    <img width="100%" src="https://storage.googleapis.com/pod_public/1300/88149.jpg" alt="">
                </div>
            </div>
        <?php } ?>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>