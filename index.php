<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KBS_Q_Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: black;
            color: white;
            text-align: center;
            padding: 20px;
        }
        button {
            padding: 10px 20px;
            margin: 5px;
            font-size: 16px;
            cursor: pointer;
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
            font-size: 24px;
        }
        #missed-queue {
            color: white;
            font-size: 20px;
        }
        #failed-queue {
            color: red;
            font-size: 22px;
        }
    </style>
</head>
<body>
    <h1>ระบบเรียกคิวรถบรรทุกอ้อย</h1>
    <div id="time"></div>
    <div class="queue-info">
        <span id="normal-queue">คิวปกติ: 0-0</span>
        <span id="missed-queue">ตกคิว: 0-0</span>
        <span id="failed-queue">คิวเสีย: 0-0</span>
    </div>
    <button onclick="callQueue()">เรียกคิว</button>
    <button onclick="resetQueue()">รีเซ็ต</button>
    <button onclick="AutoQueue()">เรียกคิวอัตโนมัติ</button>
    <button onclick="StopAutoQueue()">หยุดเรียกคิวอัตโนมัติ</button>

    <script>
        let autoQueueInterval = null;

        function updateTime() {
            const now = new Date();
            document.getElementById('time').textContent = `เวลา: ${now.toLocaleString()}`;
        }
        setInterval(updateTime, 1000);

        function callQueue() {
            fetch('queue_system.php?action=call')
                .then(response => response.json())
                .then(data => {
                    updateQueueDisplay(data); // อัปเดตข้อมูลคิวใน DOM
                    alert(data.message);
                })
                .catch(error => console.error('Error:', error));
        }

        function updateQueueDisplay(data) {
            // อัปเดตข้อมูลคิวใน DOM
            document.getElementById('normal-queue').textContent = `คิวปกติ: ${data.normal_queue_start}-${data.normal_queue_end}`;
            document.getElementById('missed-queue').textContent = `ตกคิว: ${data.missed_queue_start}-${data.missed_queue_end}`;
            document.getElementById('failed-queue').textContent = `คิวเสีย: ${data.failed_queue_start}-${data.failed_queue_end}`;
        }

        function resetQueue() {
            fetch('queue_system.php?action=reset')
                .then(response => response.json())
                .then(data => {
                    // รีเซ็ตค่าคิวใน DOM
                    document.getElementById('normal-queue').textContent = 'คิวปกติ: 0-0';
                    document.getElementById('missed-queue').textContent = 'ตกคิว: 0-0';
                    document.getElementById('failed-queue').textContent = 'คิวเสีย: 0-0';
                    alert(data.message);
                })
                .catch(error => console.error('Error:', error));
        }

        function AutoQueue() {
            if (!autoQueueInterval) {
                autoQueueInterval = setInterval(() => {
                    fetch('queue_system.php?action=call')
                        .then(response => response.json())
                        .then(data => {
                            updateQueueDisplay(data); // อัปเดตข้อมูลคิวใน DOM
                        })
                        .catch(error => console.error('Error:', error));
                }, 7200000); // 2 ชั่วโมง = 7200000 มิลลิวินาที
                alert('เปิดใช้งานการเรียกคิวอัตโนมัติทุก 2 ชั่วโมง');
            } else {
                alert('การเรียกคิวอัตโนมัติกำลังทำงานอยู่');
            }
        }

        function StopAutoQueue() {
            if (autoQueueInterval) {
                clearInterval(autoQueueInterval);
                autoQueueInterval = null;
                alert('หยุดการเรียกคิวอัตโนมัติแล้ว');
            } else {
                alert('การเรียกคิวอัตโนมัติไม่ได้ทำงาน');
            }
        }
    </script>
</body>
</html>
