<?php
$host = 'localhost';
$dbname = 'queue_aoi';
$username = 'root';
$password = '';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

function sendLineNotify($message) {
    $token = "goLz2HMi1EGOjGvmqWRW1Ex3r8NObOb8JO9AYNlSUqm";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://notify-api.line.me/api/notify");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['message' => $message]));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer $token"]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

$action = $_GET['action'] ?? '';
if ($action === 'call') {
    $stmt = $conn->query("SELECT * FROM queue_history ORDER BY id DESC LIMIT 1");
    $lastQueue = $stmt->fetch(PDO::FETCH_ASSOC);

    $normal_start = $lastQueue ? $lastQueue['normal_queue_end'] + 1 : 1;
    $normal_end = $normal_start + 199;

    // ตรวจสอบว่าเกิน 3000 หรือไม่
    if ($normal_end >= 3000) {
        $normal_start = 1;
        $normal_end = 200;
    }

    $missed_start = $lastQueue ? $lastQueue['normal_queue_start'] : 0;
    $missed_end = $lastQueue ? $lastQueue['normal_queue_end'] : 0;
    $failed_start = $lastQueue ? max(0, $missed_start - 200) : 0;
    $failed_end = $lastQueue ? max(0, $missed_start - 1) : 0;

    $stmt = $conn->prepare("INSERT INTO queue_history (normal_queue_start, normal_queue_end, missed_queue_start, missed_queue_end, failed_queue_start, failed_queue_end) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$normal_start, $normal_end, $missed_start, $missed_end, $failed_start, $failed_end]);

    $message = "เรียกคิวใหม่แล้ว!!!\nคิวปกติ: $normal_start-$normal_end\nตกคิว: $missed_start-$missed_end\nคิวเสีย: $failed_start-$failed_end";
    sendLineNotify($message);

    echo json_encode([
        'normal_queue_start' => $normal_start,
        'normal_queue_end' => $normal_end,
        'missed_queue_start' => $missed_start,
        'missed_queue_end' => $missed_end,
        'failed_queue_start' => $failed_start,
        'failed_queue_end' => $failed_end,
        'message' => 'คิวถูกเรียกเรียบร้อยแล้ว'
    ]);
} elseif ($action === 'reset') {
    $conn->query("TRUNCATE TABLE queue_history");
    echo json_encode(['message' => 'รีเซ็ตข้อมูลคิวเรียบร้อยแล้ว']);
}
