<?php
//Table Generation
function tableStaffShow($conn) {
    $sql = "SELECT * FROM staff";
    $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
    while ($record = mysqli_fetch_assoc($resultset)) {
                                    echo '<tr>
                                        <th scope="row">
                                            ' . $record['staff_id'] . '
                                        </th>
                                        <td>
                                        ' . $record['staff_first_name'] . '
                                        </td>
                                        <td>
                                        ' . $record['staff_last_name'] . '
                                        </td>
                                        <td>
                                        ' . $record['staff_gender'] . '
                                        </td>
                                        <td>
                                        ' . $record['staff_position'] . '
                                        </td>
                                        <td>
                                        ' . $record['staff_phone'] . '
                                        </td>
                                        <td>
                                        ' . $record['staff_email'] . '
                                        </td>
                                        <td>
                                        ' . $record['staff_salary'] . '
                                        </td>
                                        <td>
                                        ' . $record['staff_start_date'] . '
                                        </td>
                                        <td>
                                        ' . $record['staff_national_insurance'] . '
                                        </td>
                                        <td>
                                        ' . $record['branch_branch_id'] . '
                                        </td>
                                        <td>
                                        ' . $record['address_address_id'] . '
                                        </td>
                                    </tr>';
    }
}

function tableStaffStaffShow($conn) {
    $sql = "SELECT * FROM viewstaff_staff";
    $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
    while ($record = mysqli_fetch_assoc($resultset)) {
                                    echo '<tr>
                                        <th scope="row">
                                            ' . $record['staff_id'] . '
                                        </th>
                                        <td>
                                        ' . $record['staff_first_name'] . '
                                        </td>
                                        <td>
                                        ' . $record['staff_last_name'] . '
                                        </td>
                                        <td>
                                        ' . $record['staff_gender'] . '
                                        </td>
                                        <td>
                                        ' . $record['staff_position'] . '
                                        </td>
                                        <td>
                                        ' . $record['staff_phone'] . '
                                        </td>
                                        <td>
                                        ' . $record['staff_email'] . '
                                        </td>
                                        <td>
                                        ' . $record['branch_branch_id'] . '
                                        </td>
                                    </tr>';
    }
}

function tableAttractShow($conn) {
    $sql = "SELECT * FROM attractions";
    $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
    while ($record = mysqli_fetch_assoc($resultset)) {
                                    echo '<tr>
                                        <th scope="row">
                                            ' . $record['attract_id'] . '
                                        </th>
                                        <td>
                                        ' . $record['attract_location'] . '
                                        </td>
                                        <td>
                                        ' . $record['attract_type'] . '
                                        </td>
                                        <td>
                                        ' . $record['attract_image'] . '
                                        </td>
                                        <td>
                                        ' . $record['address_address_id'] . '
                                        </td>
                                    </tr>';
    }
}

function tableBookingsShow($conn) {
    $sql = "SELECT * FROM booking";
    $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
    while ($record = mysqli_fetch_assoc($resultset)) {
                                    echo '<tr>
                                        <th scope="row">
                                            ' . $record['booking_id'] . '
                                        </th>
                                        <td>
                                        ' . $record['booking_reference'] . '
                                        </td>
                                        <td>
                                        ' . $record['booking_date'] . '
                                        </td>
                                        <td>
                                        ' . $record['booking_details'] . '
                                        </td>
                                        <td>
                                        ' . $record['customers_customer_id'] . '
                                        </td>
                                        <td>
                                        ' . $record['branch_branch_id'] . '
                                        </td>
                                        <td>
                                        ' . $record['package_pkg_id'] . '
                                        </td>
                                        <td>
                                        ' . $record['service_booking_id'] . '
                                        </td>
                                    </tr>';
    }
}

function tableBranchesShow($conn) {
    $sql = "SELECT * FROM branch";
    $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
    while ($record = mysqli_fetch_assoc($resultset)) {
                                    echo '<tr>
                                        <th scope="row">
                                            ' . $record['branch_id'] . '
                                        </th>
                                        <td>
                                        ' . $record['branch_name'] . '
                                        </td>
                                        <td>
                                        ' . $record['branch_phone_number'] . '
                                        </td>
                                        <td>
                                        ' . $record['branch_email'] . '
                                        </td>
                                        <td>
                                        ' . $record['address_address_id'] . '
                                        </td>
                                    </tr>';
    }
}

function tableCustomersShow($conn) {
    $sql = "SELECT * FROM customers";
    $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
    while ($record = mysqli_fetch_assoc($resultset)) {
                                    echo '<tr>
                                        <th scope="row">
                                            ' . $record['customer_id'] . '
                                        </th>
                                        <td>
                                        ' . $record['customer_first_name'] . '
                                        </td>
                                        <td>
                                        ' . $record['customer_last_name'] . '
                                        </td>
                                        <td>
                                        ' . $record['customer_phone'] . '
                                        </td>
                                        <td>
                                        ' . $record['customer_email'] . '
                                        </td>
                                        <td>
                                        ' . $record['customer_age'] . '
                                        </td>
                                        <td>
                                        ' . $record['customer_gender'] . '
                                        </td>
                                        <td>
                                        ' . $record['customer_nationality'] . '
                                        </td>
                                        <td>
                                        ' . $record['address_address_id'] . '
                                        </td>
                                    </tr>';
    }
}

function tableOneCustomerShow($conn, $selected_id) {
    $sql = "SELECT * FROM customers WHERE customer_id = $selected_id";
    $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
    while ($record = mysqli_fetch_assoc($resultset)) {
                                    echo '<tr>
                                        <th scope="row">
                                            ' . $record['customer_id'] . '
                                        </th>
                                        <td>
                                        ' . $record['customer_first_name'] . '
                                        </td>
                                        <td>
                                        ' . $record['customer_last_name'] . '
                                        </td>
                                        <td>
                                        ' . $record['customer_phone'] . '
                                        </td>
                                        <td>
                                        ' . $record['customer_email'] . '
                                        </td>
                                        <td>
                                        ' . $record['customer_age'] . '
                                        </td>
                                        <td>
                                        ' . $record['customer_gender'] . '
                                        </td>
                                        <td>
                                        ' . $record['customer_nationality'] . '
                                        </td>
                                        <td>
                                        ' . $record['address_address_id'] . '
                                        </td>
                                    </tr>';
    }
}

function tableEquipmentShow($conn) {
    $sql = "SELECT * FROM equipment";
    $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
    while ($record = mysqli_fetch_assoc($resultset)) {
                                    echo '<tr>
                                        <th scope="row">
                                            ' . $record['equip_id'] . '
                                        </th>
                                        <td>
                                        ' . $record['equip_type'] . '
                                        </td>
                                        <td>
                                        ' . $record['equip_value'] . '
                                        </td>
                                        <td>
                                        ' . $record['equip_description'] . '
                                        </td>
                                        <td>
                                        ' . $record['equip_insured'] . '
                                        </td>
                                        <td>
                                        ' . $record['equip_required_training'] . '
                                        </td>
                                        <td>
                                        ' . $record['branch_branch_id'] . '
                                        </td>
                                    </tr>';
    }
}

function tableMarketingShow($conn) {
    $sql = "SELECT * FROM marketing";
    $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
    while ($record = mysqli_fetch_assoc($resultset)) {
                                    echo '<tr>
                                        <th scope="row">
                                            ' . $record['pr_id'] . '
                                        </th>
                                        <td>
                                        ' . $record['pr_description'] . '
                                        </td>
                                        <td>
                                        ' . $record['pr_type'] . '
                                        </td>
                                        <td>
                                        ' . $record['pr_budget'] . '
                                        </td>
                                        <td>
                                        ' . $record['pr_start_date'] . '
                                        </td>
                                        <td>
                                        ' . $record['pr_end_date'] . '
                                        </td>
                                        <td>
                                        ' . $record['package_pkg_id'] . '
                                        </td>
                                    </tr>';
    }
}

function tablePackagesShow($conn) {
    $sql = "SELECT * FROM package";
    $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
    while ($record = mysqli_fetch_assoc($resultset)) {
                                    echo '<tr>
                                        <th scope="row">
                                            ' . $record['pkg_id'] . '
                                        </th>
                                        <td>
                                        ' . $record['pkg_price'] . '
                                        </td>
                                        <td>
                                        ' . $record['pkg_city'] . '
                                        </td>
                                        <td>
                                        ' . $record['pkg_country'] . '
                                        </td>
                                        <td>
                                        ' . $record['pkg_internal_cost'] . '
                                        </td>
                                        <td>
                                        ' . $record['pkg_description'] . '
                                        </td>
                                        <td>
                                        ' . $record['pkg_image'] . '
                                        </td>
                                        <td>
                                        ' . $record['pp_id'] . '
                                        </td>
                                        <td>
                                        ' . $record['availability_avail_id'] . '
                                        </td>
                                        <td>
                                        ' . $record['attractions_attract_id'] . '
                                        </td>
                                    </tr>';
    }
}

function tableServicesShow($conn) {
    $sql = "SELECT * FROM services";
    $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
    while ($record = mysqli_fetch_assoc($resultset)) {
                                    echo '<tr>
                                        <th scope="row">
                                            ' . $record['service_id'] . '
                                        </th>
                                        <td>
                                        ' . $record['service_flights'] . '
                                        </td>
                                        <td>
                                        ' . $record['service_holidays'] . '
                                        </td>
                                        <td>
                                        ' . $record['service_destinations'] . '
                                        </td>
                                        <td>
                                        ' . $record['service_accomodation'] . '
                                        </td>
                                        <td>
                                        ' . $record['service_cost'] . '
                                        </td>
                                        <td>
                                        ' . $record['service_provider_provider_id'] . '
                                        </td>
                                    </tr>';
    }
}
?>