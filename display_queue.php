<?php
// ตั้งค่าเชื่อมต่อฐานข้อมูล
$host = 'localhost';
$dbname = 'queue_aoi';
$username = 'root';
$password = '';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

// ดึงข้อมูลคิวล่าสุดจากฐานข้อมูล
$stmt = $conn->query("SELECT * FROM queue_history ORDER BY id DESC LIMIT 1");
$lastQueue = $stmt->fetch(PDO::FETCH_ASSOC);

// ถ้าหากข้อมูลคิวมีการบันทึกแล้ว
if ($lastQueue) {
    $normal_start = $lastQueue['normal_queue_start'];
    $normal_end = $lastQueue['normal_queue_end'];
    $missed_start = $lastQueue['missed_queue_start'];
    $missed_end = $lastQueue['missed_queue_end'];
    $failed_start = $lastQueue['failed_queue_start'];
    $failed_end = $lastQueue['failed_queue_end'];
} else {
    // ถ้าไม่มีข้อมูลในฐานข้อมูล
    $normal_start = $normal_end = $missed_start = $missed_end = $failed_start = $failed_end = 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="refresh" content="5">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KBS_Q_Display</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: black;
            color: white;
            text-align: center;
            padding: 20px;
        }
        .queue-info {
            margin: 20px 0;
        }
        .queue-info span {
            display: block;
            margin: 10px 0;
        }
        #normal-queue {
            color: white;
            font-size: 100px;
        }
        #missed-queue {
            color: white;
            font-size: 100px;
        }
        #failed-queue {
            color: red;
            font-size: 100px;
        }
        #time {
            color: white;
            font-size: 60px;
            margin-top: 200px;
        }
    </style>
</head>
<body>
    <h1></h1>
    
    
    <div id="time"></div>
    
    <div class="queue-info">
        <span id="normal-queue">คิวปกติ: <?php echo $normal_start . "-" . $normal_end; ?></span>
        <span id="missed-queue">ตกคิว: <?php echo $missed_start . "-" . $missed_end; ?></span>
        <span id="failed-queue">คิวเสีย: <?php echo $failed_start . "-" . $failed_end; ?></span>
    </div>

    <div id="queue-display">
        
    </div>

    <script>
       
        function updateQueueData() {
            fetch('display_queue.php')
                .then(response => response.text())
                .then(data => {
                    // เคลียร์ข้อมูลเก่าก่อนแสดงข้อมูลใหม่
                    const queueDisplayElement = document.getElementById('queue-display');
                    queueDisplayElement.innerHTML = ''; // เคลียร์ข้อมูลเก่า
                    queueDisplayElement.innerHTML = data; // แสดงข้อมูลใหม่
                })
                .catch(error => console.error('Error fetching queue data:', error));
        }

        //  updateQueueData ทุกๆ 5 วินาที
     //setInterval(updateQueueData, 5000);

        // แสดงเวลาปัจจุบัน
        function updateTime() {
            const now = new Date();
            const timeString = `เวลา: ${now.toLocaleString()}`;
            document.getElementById('time').textContent = timeString;
        }

        // เวลาทุกๆ 1 วินาที
        setInterval(updateTime, );
    </script>
</body>
</html>
