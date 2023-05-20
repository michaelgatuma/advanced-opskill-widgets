<?php
require_once plugin_dir_path( __FILE__ ) . '../config.php';

// Your data query code here...
function fetch_academic_levels() {
    // Create connection
    $conn = new mysqli(AOW_DB_SERVER, AOW_DB_USERNAME, AOW_DB_PASSWORD, AOW_DB_NAME);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT value, id, name FROM oppo_levels";
    $result = $conn->query($sql);

    $academic_levels = [];
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $academic_levels[] = $row;
        }
    } else {
        echo "0AL";
    }

    $conn->close();

    return $academic_levels;
}

function fetch_subjects() {
    // Create connection
    $conn = new mysqli(AOW_DB_SERVER, AOW_DB_USERNAME, AOW_DB_PASSWORD, AOW_DB_NAME);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT value, name FROM oppo_subjects";
    $result = $conn->query($sql);

    $subjects = [];
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $subjects[] = $row;
        }
    } else {
        echo "0S";
    }

    $conn->close();

    return $subjects;
}

function fetch_urgency() {
    // Create connection
    $conn = new mysqli(AOW_DB_SERVER, AOW_DB_USERNAME, AOW_DB_PASSWORD, AOW_DB_NAME);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //$sql2 = "SELECT pricing_value, pricing_id, pricing_urgency, pricing_duration FROM ops_pricing ORDER BY pricing_value ASC";
    $sql = "SELECT value, id, urgency, duration FROM oppo_urgency WHERE site = '".get_domain()."' ORDER BY value ASC";
    $result = $conn->query($sql);

    $urgency = [];
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $urgency[] = $row;
        }
    } else {
        echo "0U";
    }

    $conn->close();

    return $urgency;
}

function fetch_paper_types() {
    // Create connection
    $conn = new mysqli(AOW_DB_SERVER, AOW_DB_USERNAME, AOW_DB_PASSWORD, AOW_DB_NAME);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //$sqll2 = "SELECT pptype_pvalue, pptype_name FROM ops_pptypes";
    $sql = "SELECT value, name FROM oppo_pptypes";
    $result = $conn->query($sql);

    $pptypes = [];
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $pptypes[] = $row;
        }
    } else {
        echo "0PT";
    }

    $conn->close();

    return $pptypes;
}

function fetch_services() {
    // Create connection
    $conn = new mysqli(AOW_DB_SERVER, AOW_DB_USERNAME, AOW_DB_PASSWORD, AOW_DB_NAME);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //$sql33 = "SELECT service_price, id, service_names FROM ops_service";
    $sql = "SELECT value, id, name FROM oppo_service";
    $result = $conn->query($sql);

    $services = [];
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $services[] = $row;
        }
    } else {
        echo "0 results";
    }

    $conn->close();

    return $services;
}

function fetch_writers() {
    // Create connection
    $conn = new mysqli(AOW_DB_SERVER, AOW_DB_USERNAME, AOW_DB_PASSWORD, AOW_DB_NAME);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //$sql4 = "SELECT writer_id, writer_fname, writer_nickname, writer_subjects FROM ops_writers";
    $sql = "SELECT id, fname, nickname, subjects FROM oppo_writers WHERE site = '".get_domain()."'";
    $result = $conn->query($sql);

    $opwriters = [];
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $opwriters[] = $row;
        }
    } else {
        echo "0 results";
    }

    $conn->close();

    return $opwriters;
}

function get_domain() {
    $domain = site_url();
    $domain = str_replace('https://', '', $domain);
    $domain = str_replace('http://', '', $domain);
    $domain = str_replace('www', '', $domain);
//    $domain = strstr($domain, '/', true);
    return $domain;
}


//$sql = "SELECT aclevel_value, aclevel_id, aclevel_name FROM ops_aclevel";
//$academic_levels = mysqli_query($conn, $sql);
//
//$sql1 = "SELECT sub_pvalue, sub_name FROM ops_subjects";
//$subjects = mysqli_query($conn, $sql1);
//
//$sql2 = "SELECT pricing_value, pricing_id, pricing_urgency, pricing_duration FROM ops_pricing ORDER BY pricing_value ASC";
//$urgency = mysqli_query($conn, $sql2);
//
//$sqll2 = "SELECT pptype_pvalue, pptype_name FROM ops_pptypes";
//$pptypes = mysqli_query($conn, $sqll2);
//
//$sql3 = "SELECT pptype_pvalue, pptype_name FROM ops_pptypes";
//$pptype = mysqli_query($conn, $sql3);
//
//$sql33 = "SELECT service_price, id, service_names FROM ops_service";
//$services = mysqli_query($conn, $sql33);
//
//$sql4 = "SELECT writer_id, writer_fname, writer_nickname, writer_subjects FROM ops_writers";
//$opwriters = mysqli_query($conn, $sql4);
//
//$sql6 = "SELECT order_wramount, order_id, order_subject, order_tpaper, order_title, ops_aclevel, order_pages FROM ops_orders ORDER BY order_id DESC LIMIT 10";
//$latest10 = mysqli_query($conn, $sql6);
//
//$sql5 = "SELECT order_id, order_title, order_tpaper, order_clientid, order_subject, order_pages, order_subject, order_dateposted, order_writer, order_rating, order_ratecomment FROM ops_orders WHERE order_rating > 0 ORDER BY order_id DESC LIMIT 5";
//$opreviews = mysqli_query($conn, $sql5);
