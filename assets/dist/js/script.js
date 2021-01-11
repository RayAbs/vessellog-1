function additional_stay() {
    var new_addstay;
    var berth_etd = $('#berth_etd').val();
    var berth_atd = $('#berth_atd').val();
    if (berth_etd) {
        var start_date = new Date(berth_etd);
    }
    if (berth_atd) {
        var end_date = new Date(berth_atd);
    }
    if (end_date && start_date) {
        var diff_date = end_date - start_date;
        var days = diff_date / (1000 * 60 * 60 * 24);
        var num_type = days % 1 !== 0;
        if (num_type === false) {
            new_addstay = days;
        } else {
            new_addstay = days.toFixed(1);
        }
        $('#addnumstay').val(new_addstay);
    }
}
function focus_additionalstay() {
    $('#berth_atd').focus(function () {
        additional_stay();
    });
    $('#berth_atd').focusout(function () {
        additional_stay();
    });
}
/* FUNCTION WHEN VESSEL NAME/SCN/VOYAGENO INPUT IS BEING FOCUSED */
function focus_particulars() {
    $('#vesselname').keyup(function () {
        var vesselname = $(this).val();
        particulars(vesselname);
    });
    $('#vesselname').focus(function () {
        var vesselname = $(this).val();
        particulars(vesselname);
    });
    $('#vesselname').focusin(function () {
        var vesselname = $(this).val();
        particulars(vesselname);
    });
    $('#vesselname').focusout(function () {
        var vesselname = $(this).val();
        particulars(vesselname);
    });
}

/* FUNCTION WHEN BERTH INPUTS ARE BEING FOCUSED */
function focus_berth() {
    $('#berth_eta').focus(function () {
        if ($(this).val()) {
            $('#berth_ata').prop('required', true);
        } else {
            $('#berth_ata').prop('required', false);
        }
    });
    $('#berth_eta').focusin(function () {
        if ($(this).val()) {
            $('#berth_ata').prop('required', true);
        } else {
            $('#berth_ata').prop('required', false);
        }
    });
    $('#berth_eta').focusout(function () {
        if ($(this).val()) {
            $('#berth_ata').prop('required', true);
        } else {
            $('#berth_ata').prop('required', false);
        }
    });
    $('#berth_etd').focus(function () {
        if ($(this).val()) {
            $('#berth_atd').prop('required', true);
        } else {
            $('#berth_atd').prop('required', false);
        }
    });
    $('#berth_etd').focusin(function () {
        if ($(this).val()) {
            $('#berth_atd').prop('required', true);
        } else {
            $('#berth_atd').prop('required', false);
        }
    });
    $('#berth_etd').focusout(function () {
        if ($(this).val()) {
            $('#berth_atd').prop('required', true);
        } else {
            $('#berth_atd').prop('required', false);
        }
    });
}

/* AJAX REQUEST ON GETTING THE PARTICULARS AND VESSEL DETAILS USING VOYAGE NO */
//function particulars(voyageno, vesselname) {
function particulars(vesselname) {
    if (vesselname) {
        $.ajax({
            type: "POST",
            url: baseurl + "home/particulars",
            async: true,
            dataType: 'JSON',
            data: {vesselname: vesselname},
            success: function (data) {
                if (data) {
                    for (var i = 0; i < data.length; i++) {
                        var vesselid = data[i].vesselid;
                        var grt = data[i].grt;
                        var nrt = data[i].nrt;
                        var dwt = data[i].dwt;
                        var beam = data[i].beam;
                        var loa = data[i].loa;
                        var draft = data[i].draft;
                        $("#vesselid").val(vesselid);
                        $("#grt").val(grt);
                        $("#nrt").val(nrt);
                        $("#dwt").val(dwt);
                        $("#beam").val(beam);
                        $("#loa").val(loa);
                        $("#draft").val(draft);
                        $("#grt").attr("readonly", true);
                        $("#nrt").attr("readonly", true);
                        $("#dwt").attr("readonly", true);
                        $("#beam").attr("readonly", true);
                        $("#loa").attr("readonly", true);
                        $("#draft").attr("readonly", true);
                    }
                }
            },
        });
    } else {
        $("#vesselid").val("");
        $("#scn").val("");
        $("#grt").val("");
        $("#nrt").val("");
        $("#dwt").val("");
        $("#beam").val("");
        $("#loa").val("");
        $("#draft").val("");
        $("#grt").attr("readonly", false);
        $("#nrt").attr("readonly", false);
        $("#dwt").attr("readonly", false);
        $("#beam").attr("readonly", false);
        $("#loa").attr("readonly", false);
        $("#draft").attr("readonly", false);
    }
}
/* FUNCTION WHEN ADDITIONAL STAY INPUT IS BEING FOCUSED */
function focus_addstay() {
    /* CHECK FOR ADDITIONAL STAY VALUES */
    $('#addnumstay').focusout(function () {
        if ($(this).val()) {
            $("#ornumaddstay").prop('required', true);
            $("#paymentaddstay").prop('required', true);
            $("#addapprovedoption").prop('required', true);
        } else {
            $("#ornumaddstay").prop('required', false);
            $("#paymentaddstay").prop('required', false);
            $("#addapprovedoption").prop('required', false);
        }
    });
    /* CHECK FOR ADDITIONAL STAY VALUES */
    $('#addnumstay').focus(function () {
        if ($(this).val()) {
            $("#ornumaddstay").prop('required', true);
            $("#paymentaddstay").prop('required', true);
            $("#addapprovedoption").prop('required', true);
        } else {
            $("#ornumaddstay").prop('required', false);
            $("#paymentaddstay").prop('required', false);
            $("#addapprovedoption").prop('required', false);
        }
    });
    /* CHECK FOR ADDITIONAL STAY VALUES */
    $("#addnumstay").keyup(function () {
        if ($(this).val()) {
            $("#ornumaddstay").prop('required', true);
            $("#paymentaddstay").prop('required', true);
            $("#addapprovedoption").prop('required', true);
        } else {
            $("#ornumaddstay").prop('required', false);
            $("#paymentaddstay").prop('required', false);
            $("#addapprovedoption").prop('required', false);
        }
    });
    /* CHECK FOR ADDITIONAL STAY VALUES */
    $("#addnumstay").focus(function () {
        if ($(this).val()) {
            $("#ornumaddstay").prop('required', true);
            $("#paymentaddstay").prop('required', true);
            $("#addapprovedoption").prop('required', true);
        } else {
            $("#ornumaddstay").prop('required', false);
            $("#paymentaddstay").prop('required', false);
            $("#addapprovedoption").prop('required', false);
        }
    });
    $("#addapprovedoption").focus(function () {
        var addnumstay = $("#addnumstay").val();
        var ornumaddstay = $("#ornumaddstay").val();
        var paymentaddstay = $("#paymentaddstay").val();
        if ($(this).val()) {
            if (addnumstay === "") {
                $("#addnumstay").prop('required', true);
            }
            if (ornumaddstay === "") {
                $("#ornumaddstay").prop('required', true);
            }
            if (paymentaddstay === "") {
                $("#paymentaddstay").prop('required', true);
            }
        } else {
            $("#ornumaddstay").prop('required', false);
            $("#paymentaddstay").prop('required', false);
            $("#addapprovedoption").prop('required', false);
        }
    });
}
/* FUNCTION TO DISPLAY DROPDOWN LIST OF YEARS */
function get_years() {
    var current_year = new Date().getFullYear();
    var min_year = 2019;
    var max_year = current_year + 10;
    var i;
    for (i = min_year; i < max_year; i++) {
        if (yearly_report == i) {
            $("#yearly_report").append('<option selected value="' + yearly_report + '">' + yearly_report + '</option>');
        } else {
            $("#yearly_report").append('<option value="' + i + '">' + i + '</option>');
        }
    }
}
/* FUNCTION TO LOAD AND CONVERT IMAGES TO BASE 64 FORMAT */
function generatereport() {
    var data;
    if (daily_report) {
        data = {
            typeofport: typeofport,
            daily_report: daily_report
        };
    } else if (weekly_from && weekly_to) {
        data = {
            typeofport: typeofport,
            weekly_from: weekly_from,
            weekly_to: weekly_to
        };
    } else if (monthly_report) {
        data = {
            typeofport: typeofport,
            monthly_report: monthly_report
        };
    } else if (yearly_report) {
        data = {
            typeofport: typeofport,
            yearly_report: yearly_report
        };
    } else {
        data = {
            typeofport: typeofport
        };
    }
    $.ajax({
        type: "POST",
        //  url: baseurl + "home/all_transactions",
        url: baseurl + "home/generate_report",
        async: true,
        dataType: 'JSON',
        data: data,
        success: function (data) {
            if (data.data.length > 0) {
                /* CODE FOR GETTING ALL SIGNATURES FOUND IN DATABASE/TABLE */
                for (var a = 0; a < data.data.length; a++) {
                    if (data.data[a].client_signature) {
                        var client_imagepath = baseurl + "assets/images/signatures/client/" + data.data[a].client_signature;
                        imgToBase64(client_imagepath, function (myBase64) {
                            client_signatures.push(myBase64);
                        });
                    }

                    if (data.data[a].ppa_signature) {
                        var ppa_imagepath = baseurl + "assets/images/signatures/ppa/" + data.data[a].ppa_signature;
                        imgToBase64(ppa_imagepath, function (myBase64) {
                            ppa_signatures.push(myBase64);
                        });
                    }
                    if (data.data[a].client_addstaysign !== null && data.data[a].client_addstaysign !== "") {
                        var client_asimgpath = baseurl + "assets/images/signatures/client/" + data.data[a].client_addstaysign;
                        imgToBase64(client_asimgpath, function (myBase64) {
                            client_addstaysign.push(myBase64);
                        });
                    }
                    if (data.data[a].ppa_addstaysign !== null && data.data[a].ppa_addstaysign !== "") {
                        var ppa_asimgpath = baseurl + "assets/images/signatures/ppa/" + data.data[a].ppa_addstaysign;
                        imgToBase64(ppa_asimgpath, function (myBase64) {
                            ppa_addstaysign.push(myBase64);
                        });
                    }
                }
            }
        }
    });
    imgToBase64(logo_src, function (myBase64) {
        logo = myBase64;
        create_report(); // GENERATE VESSEL LOG BOOK TO PDF
    });
}
/* FUNCTION TO GENERATE REPORT IN PDF FORMAT */
function create_report() {
    var doc = new jsPDF('l', 'pt', 'a1'); // INITIALIZE JSDF LIBRARY
    var data, anchor_ata_date, anchor_ata_time, anchor_atd_date, anchor_atd_time, berth_ata_date, berth_ata_time, berth_etd_date, berth_etd_time, berth_atd_date, berth_atd_time, payment, payment_addstay, status;
    var rows = []; // ARRAY FOR ROWS FOR THE BODY OF TABLE
    if (daily_report) {
        data = {
            typeofport: typeofport,
            daily_report: daily_report
        };
    } else if (weekly_from && weekly_to) {
        data = {
            typeofport: typeofport,
            weekly_from: weekly_from,
            weekly_to: weekly_to
        };
    } else if (monthly_report) {
        data = {
            typeofport: typeofport,
            monthly_report: monthly_report
        };
    } else if (yearly_report) {
        data = {
            typeofport: typeofport,
            yearly_report: yearly_report
        };
    } else {
        data = {
            typeofport: typeofport
        };
    }
    /* AJAX REQUEST TO GET ALL THE TRANSACTIONS FROM DATABASE */
    $.ajax({
        type: "POST",
        //  url: baseurl + "home/all_transactions",
        url: baseurl + "home/generate_report",
        async: true,
        dataType: 'JSON',
        data: data,
        success: function (data) {
            /* CODE FOR ALL DATA FOUND IN TABLE */
            if (data.data.length > 0) {
                /* FETCH ALL DATA FROM THE AJAX REQUEST */
                for (var i = 0; i < data.data.length; i++) {
                    /* FORMAT TRANSACTION DATE */
                    var raw_transacdate = data.data[i].transaction_date;
                    var transaction_date = getFormattedDate(raw_transacdate);

                    var raw_status = data.data[i].status;
                    if (raw_status === "done") {
                        status = "cleared";
                    } else {
                        status = raw_status;
                    }
                    /* FORMAT ANCHORAGE ATA ROW DETAILS */
                    var raw_anchor_ata = data.data[i].anchor_ata;
                    if (raw_anchor_ata) {
                        anchor_ata_date = getFormattedDate(raw_anchor_ata);
                        anchor_ata_time = getFormattedTime(raw_anchor_ata);
                    } else {
                        anchor_ata_date = " ";
                        anchor_ata_time = " ";
                    }
                    /* ANCHORAGE ATD ROW DETAILS */
                    var raw_anchor_atd = data.data[i].anchor_atd;
                    if (raw_anchor_atd) {
                        anchor_atd_date = getFormattedDate(raw_anchor_atd);
                        anchor_atd_time = getFormattedTime(raw_anchor_atd);
                    } else {
                        anchor_atd_date = " ";
                        anchor_atd_time = " ";
                    }
                    /* BERTH ATA ROW DETAILS */
                    var raw_berth_ata = data.data[i].berth_ata;
                    if (raw_berth_ata) {
                        berth_ata_date = getFormattedDate(raw_berth_ata);
                        berth_ata_time = getFormattedTime(raw_berth_ata);
                    } else {
                        berth_ata_date = " ";
                        berth_ata_time = " ";
                    }
                    /* BERTH ETD ROW DETAILS*/
                    var raw_berth_etd = data.data[i].berth_etd;
                    if (raw_berth_etd) {
                        berth_etd_date = getFormattedDate(raw_berth_etd);
                        berth_etd_time = getFormattedTime(raw_berth_etd);
                    } else {
                        berth_etd_date = " ";
                        berth_etd_time = " ";
                    }
                    /* BERTH ATD ROW DETAILS */
                    var raw_berth_atd = data.data[i].berth_atd;
                    if (raw_berth_atd) {
                        berth_atd_date = getFormattedDate(raw_berth_atd);
                        berth_atd_time = getFormattedTime(raw_berth_atd);
                    } else {
                        berth_atd_date = " ";
                        berth_atd_time = " ";
                    }
                    /* FORMAT PAYMENT */
                    var raw_payment = data.data[i].payment;
                    if (raw_payment) {
                        payment = format_currency(raw_payment);
                    } else {
                        payment = " ";
                    }
                    /* FORMAT PAYMENT FOR ADDITIONAL STAY */
                    var raw_paymentaddstay = data.data[i].payment_addstay;
                    if (raw_paymentaddstay) {
                        payment_addstay = format_currency(raw_paymentaddstay);
                    } else {
                        payment_addstay = " ";
                    }
                    if (report_class === "standard") {
                        /* GET ALL ROW DETAILS - */
                        var row = [
                            i + 1,
                            data.data[i].scn,
                            data.data[i].vesselname,
                            data.data[i].voyageno,
                            anchor_ata_date,
                            anchor_ata_time,
                            anchor_atd_date,
                            anchor_atd_time,
                            berth_ata_date,
                            berth_ata_time,
                            berth_atd_date,
                            berth_atd_time,
                            data.data[i].berth_assignment,
                            data.data[i].grt,
                            data.data[i].nrt,
                            data.data[i].dwt,
                            data.data[i].beam,
                            data.data[i].loa,
                            data.data[i].draft,
                            data.data[i].lastport,
                            data.data[i].nextport,
                            data.data[i].passengerin,
                            data.data[i].passengerout,
                            data.data[i].ornum,
                            payment,
                            " ",
                            " ",
                            data.data[i].addnumstay,
                            data.data[i].ornum_addstay,
                            payment_addstay,
                            " ",
                            " "
                        ];
                        rows.push(row);
                    } else if (report_class === "internal") {
                        /* GET ALL ROW DETAILS - */
                        var row = [
                            status.toUpperCase(),
                            i + 1,
                            transaction_date,
                            data.data[i].transaction_id,
                            data.data[i].scn,
                            data.data[i].vesselname,
                            data.data[i].voyageno,
                            anchor_ata_date,
                            anchor_ata_time,
                            anchor_atd_date,
                            anchor_atd_time,
                            berth_ata_date,
                            berth_ata_time,
                            berth_atd_date,
                            berth_atd_time,
                            data.data[i].berth_assignment,
                            data.data[i].grt,
                            data.data[i].nrt,
                            data.data[i].dwt,
                            data.data[i].beam,
                            data.data[i].loa,
                            data.data[i].draft,
                            data.data[i].lastport,
                            data.data[i].nextport,
                            data.data[i].passengerin,
                            data.data[i].passengerout,
                            data.data[i].ornum,
                            payment,
                            " ",
                            " ",
                            data.data[i].addnumstay,
                            data.data[i].ornum_addstay,
                            payment_addstay,
                            " ",
                            " "
                        ];
                        rows.push(row);
                    }
                }
            } else {
                if (report_class === "standard") {
                    /* CODE FOR NO DATA FOUND IN TABLE */
                    var row = [{
                            content: 'No Data Available',
                            colSpan: 43,
                            styles: {
                                valign: 'middle',
                                halign: 'center',
                                fontStyle: 'bold',
                                fontSize: 15}
                        }];
                    rows.push(row);
                } else if (report_class === "internal") {
                    var row = [{
                            content: 'No Data Available',
                            colSpan: 35,
                            styles: {
                                valign: 'middle',
                                halign: 'center',
                                fontStyle: 'bold',
                                fontSize: 15}
                        }];
                    rows.push(row);
                }
            }
            /* INITIALIZE JSPDF AUTOTABLE */
            doc.autoTable({
                head: headRows(),
                margin: {top: 70},
                body: rows,
                didParseCell: function (data) {
                    if (report_class === "internal") {
                        if (data.column.index === 0 && data.row.section === 'body') {
                            if (data.cell.raw === "PENDING") {
                                data.cell.styles.fillColor = [231, 76, 60];
                                data.cell.styles.fontStyle = 'bold';
                            } else if (data.cell.raw === "CLEARED") {
                                data.cell.styles.fillColor = [0, 128, 0];
                                data.cell.styles.fontStyle = 'bold';
                            }
                        }
                    }
                },
                didDrawCell: function (data) {
                    if (report_class === "standard") {
                        if (data.column.dataKey === 25 && data.row.section === 'body') {
                            if (client_signatures[w]) {
                                doc.addImage(client_signatures[w], 'PNG', data.cell.x + 1, data.cell.y + 1, data.cell.width, 18);
                            }
                            w++;
                        } else if (data.column.dataKey === 26 && data.row.section === 'body') {
                            if (ppa_signatures[x]) {
                                doc.addImage(ppa_signatures[x], 'PNG', data.cell.x + 1, data.cell.y + 1, data.cell.width, 18);
                            }
                            x++;
                        } else if (data.column.dataKey === 30 && data.row.section === 'body') {
                            if (client_addstaysign[y]) {
                                doc.addImage(client_addstaysign[y], 'PNG', data.cell.x + 1, data.cell.y + 1, data.cell.width, 18);
                            }
                            y++;
                        } else if (data.column.dataKey === 31 && data.row.section === 'body') {
                            if (ppa_addstaysign[z]) {
                                doc.addImage(ppa_addstaysign[z], 'PNG', data.cell.x + 1, data.cell.y + 1, data.cell.width, 18);
                            }
                            z++;
                        }
                        if (data.row.index === 0 && data.row.section === "head" && data.column.dataKey === 27) {
                            var center = data.cell.width / 3;
                            doc.addImage(logo, 'PNG', data.cell.x + center, data.cell.y, 100, data.cell.height);
                        }
                    } else if (report_class === "internal") {
                        if (data.column.dataKey === 28 && data.row.section === 'body') {
                            if (client_signatures[w]) {
                                doc.addImage(client_signatures[w], 'PNG', data.cell.x + 1, data.cell.y + 1, data.cell.width, 18);
                            }
                            w++;
                        } else if (data.column.dataKey === 29 && data.row.section === 'body') {
                            if (ppa_signatures[x]) {
                                doc.addImage(ppa_signatures[x], 'PNG', data.cell.x + 1, data.cell.y + 1, data.cell.width, 18);
                            }
                            x++;
                        } else if (data.column.dataKey === 33 && data.row.section === 'body') {
                            if (client_addstaysign[y]) {
                                doc.addImage(client_addstaysign[y], 'PNG', data.cell.x + 1, data.cell.y + 1, data.cell.width, 18);
                            }
                            y++;
                        } else if (data.column.dataKey === 34 && data.row.section === 'body') {
                            if (ppa_addstaysign[z]) {
                                doc.addImage(ppa_addstaysign[z], 'PNG', data.cell.x + 1, data.cell.y + 1, data.cell.width, 18);
                            }
                            z++;
                        }
                        if (data.row.index === 0 && data.row.section === "head" && data.column.dataKey === 30) {
                            var center = data.cell.width / 3;
                            doc.addImage(logo, 'PNG', data.cell.x + center, data.cell.y, 100, data.cell.height);
                        }
                    }
                },
                theme: 'plain',
                styles: {
                    lineColor: [44, 62, 80],
                    lineWidth: 1
                },
                columnStyles: columnstyles(),
            });
            if (client_signatures) {
                doc.save('Vessels Logbook - ' + captypeofport + '.pdf'); // CREATE PDF FILE
                location.reload();
            }
        }
    });
}
function headRows() {
    if (report_class === "standard") {
        return [
            [
                /* REFERENCE CODE */
                {
                    content: 'Ref. Code:',
                    colSpan: 4,
                    styles: {halign: 'left', valign: 'middle'}
                },
                /* VESSELS LOGBOOK */
                {
                    content: 'VESSELS LOGBOOK',
                    colSpan: 23,
                    rowSpan: 3,
                    styles: {
                        halign: 'center',
                        valign: 'middle',
                        fontSize: 30,
                    }
                },
                /* LOGO */
                {
                    content: '',
                    colSpan: 5,
                    rowSpan: 3
                },
            ],
            [
                /* REVISION NO : 00 */
                {
                    content: 'Revision No.:00',
                    colSpan: 4,
                    styles: {halign: 'left', valign: 'middle'}
                },
            ],
            [
                /* DATE OF EFFECTIVITY : JUNE 05, 2018 */
                {
                    content: 'Date of Effectivity: June 05,2018',
                    colSpan: 4,
                    styles: {halign: 'left', valign: 'middle'}
                },
            ],
            [
                /* NO COLUMN */
                {
                    content: 'No.',
                    rowSpan: 3,
                    styles: {halign: 'center', valign: 'middle'}
                },

                /* SCN COLUMN */
                {
                    content: 'SCN',
                    rowSpan: 3,
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* VESSEL NAME COLUMN */
                {
                    content: 'Name of Vessel',
                    rowSpan: 3,
                    styles: {halign: 'center', valign: 'middle', cellWidth: 'auto'}
                },
                /* VOYAGE NO COLUMN */
                {
                    content: 'Voy No.',
                    rowSpan: 3,
                    styles: {halign: 'center', valign: 'middle', cellWidth: 'auto'}
                },
                /* ANCHORAGE COLUMN */
                {
                    content: 'ANCHORAGE',
                    colSpan: 4,
                    styles: {halign: 'center'}
                },
                /* BERTH COLUMN */
                {
                    content: 'BERTH',
                    colSpan: 4,
                    styles: {halign: 'center'}
                },
                /* BERTH ASSIGNMENT */
                {
                    content: 'Berth Assignment',
                    rowSpan: 3,
                    styles: {halign: 'center', valign: 'middle', cellWidth: 'auto'}
                },
                /* PARTICULARS COLUMN */
                {
                    content: 'PARTICULARS',
                    colSpan: 6,
                    rowSpan: 2,
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* PORT OF CALL COLUMN */
                {
                    content: 'Port of Call',
                    colSpan: 2,
                    rowSpan: 2,
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* PASSENGERS COLUMN */
                {
                    content: 'PASSENGERS',
                    colSpan: 2,
                    rowSpan: 2,
                    styles: {halign: 'center', valign: 'middle', cellWidth: 'auto'}
                },
                /* O.R. #/AMT PAID COLUMN */
                {
                    content: 'OFFICIAL RECEIPT NO./ AMOUNT PAID',
                    colSpan: 2,
                    rowSpan: 2,
                    styles: {halign: 'center', valign: 'middle', cellWidth: 'auto'}
                },
                /* NAME AND SIGNATURE COLUMN */
                {
                    content: 'Name & Signature',
                    colSpan: 2,
                    rowSpan: 2,
                    styles: {halign: 'center', valign: 'middle', cellWidth: 'auto'}
                },
                /* ADDITIONAL STAY COLUMN */
                {
                    content: 'ADDITIONAL STAY / NO. OF DAYS',
                    rowSpan: 3,
                    styles: {halign: 'center', valign: 'middle', cellWidth: 'auto'}
                },
                /* ADDITIONAL STAY - O.R. #/AMT PAID COLUMN */
                {
                    content: 'OFFICIAL RECEIPT NO. / AMOUNT PAID (for additional stay)',
                    colSpan: 2,
                    rowSpan: 2,
                    styles: {halign: 'center', valign: 'middle', cellWidth: 'auto'}
                },
                /*  ADDITIONAL STAY - NAME AND SIGNATURE COLUMN */
                {
                    content: 'Name & Signature',
                    colSpan: 2,
                    rowSpan: 2,
                    styles: {halign: 'center', valign: 'middle', cellWidth: 'auto'}
                }

            ],
            [
                /* ANCHORAGE ARRIVAL COLUMN */
                {
                    content: 'Arrival',
                    colSpan: 2,
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* ANCHORAGE DEPARTURE COLUMN */
                {
                    content: 'Departure',
                    colSpan: 2,
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* BERTH ARRIVAL COLUMN */
                {
                    content: 'Arrival',
                    colSpan: 2,
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* BERTH DEPARTURE COLUMN */
                {
                    content: 'Departure',
                    colSpan: 2,
                    styles: {halign: 'center', valign: 'middle'}
                },
            ],
            [
                /* ANCHORAGE ARRIVAL (ATA - DATE & TIME) COLUMN */
                {
                    content: 'Date',
                    styles: {halign: 'center', valign: 'middle'}
                },
                {
                    content: 'Time',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* ANCHORAGE DEPARTURE (ATD - DATE & TIME) COLUMN */
                {
                    content: 'Date',
                    styles: {halign: 'center', valign: 'middle'}
                },
                {
                    content: 'Time',
                    styles: {halign: 'center', valign: 'middle'}
                },

                /* BERTH ARRIVAL (ATA - DATE & TIME) COLUMN */
                {
                    content: 'Date',
                    styles: {halign: 'center', valign: 'middle'}
                },
                {
                    content: 'Time',
                    styles: {halign: 'center', valign: 'middle'}
                },

                /* BERTH DEPATURE (ATD - DATE & TIME) COLUMN */
                {
                    content: 'Date',
                    styles: {halign: 'center', valign: 'middle'}
                },
                {
                    content: 'Time',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* PARTICULARS - GT COLUMN */
                {
                    content: 'GT',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* PARTICULARS - NRT COLUMN */
                {
                    content: 'NRT',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* PARTICULARS - DWT COLUMN */
                {
                    content: 'DWT',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* PARTICULARS - Beam COLUMN */
                {
                    content: 'Beam',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* PARTICULARS - LOA COLUMN */
                {
                    content: 'LOA',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* PARTICULARS - Draft COLUMN */
                {
                    content: 'Draft',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* PORT OF CALL - LAST PORT COLUMN */
                {
                    content: 'Last',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* PORT OF CALL - Next PORT COLUMN */
                {
                    content: 'Next',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* PASSENGERS - IN COLUMN */
                {
                    content: 'In',
                    styles: {halign: 'center', valign: 'middle', cellWidth: 'auto'}
                },
                /* PASSENGERS - OUT COLUMN */
                {
                    content: 'Out',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* O.R. #/AMT PAID - O.R. # COLUMN */
                {
                    content: 'O.R. #',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* O.R. #/AMT PAID - AMT PAID COLUMN */
                {
                    content: 'Amt Paid (PHP)',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* NAME & SIGNATURE - SHIPPING AGENT COLUMN */
                {
                    content: 'Shipping Agent',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* NAME & SIGNATURE - PPA PERSONNEL COLUMN */
                {
                    content: 'PPA Personnel',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* ADDITIONAL STAY - O.R. # COLUMN */
                {
                    content: 'O.R. #',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* ADDITIONAL STAY - AMT PAID COLUMN */
                {
                    content: 'Amt Paid (PHP)',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* ADDTITIONAL STAY - NAME & SIGNATURE SHIPPING AGENT COLUMN */
                {
                    content: 'Shipping Agent',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* ADDTITIONAL STAY - NAME & SIGNATURE PPA PERSONNEL COLUMN */
                {
                    content: 'PPA Personnel',
                    styles: {halign: 'center', valign: 'middle'}
                }
            ]

        ]
    } else if (report_class === "internal") {
        return [
            [
                /* REFERENCE CODE */
                {
                    content: 'Ref. Code:',
                    colSpan: 7,
                    styles: {halign: 'left', valign: 'middle'}
                },
                /* VESSELS LOGBOOK */
                {
                    content: 'VESSELS LOGBOOK',
                    colSpan: 23,
                    rowSpan: 3,
                    styles: {
                        halign: 'center',
                        valign: 'middle',
                        fontSize: 30,
                    }
                },
                /* LOGO */
                {
                    content: '',
                    colSpan: 5,
                    rowSpan: 3
                },
            ],
            [
                /* REVISION NO : 00 */
                {
                    content: 'Revision No.:00',
                    colSpan: 7,
                    styles: {halign: 'left', valign: 'middle'}
                },
            ],
            [
                /* DATE OF EFFECTIVITY : JUNE 05, 2018 */
                {
                    content: 'Date of Effectivity: June 05,2018',
                    colSpan: 7,
                    styles: {halign: 'left', valign: 'middle'}
                },
            ],
            [
                /* STATUS COLUMN */
                {
                    content: 'Status',
                    rowSpan: 3,
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* NO COLUMN */
                {
                    content: 'No.',
                    rowSpan: 3,
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* TRANSACTION DATE COLUMN */
                {
                    content: 'Transact Date',
                    rowSpan: 3,
                    styles: {halign: 'center', valign: 'middle', cellWidth: 'auto'}
                },
                /* TRANSACTION ID COLUMN */
                {
                    content: 'Transaction ID',
                    rowSpan: 3,
                    styles: {halign: 'center', valign: 'middle', cellWidth: 'wrap'}
                },
                /* SCN COLUMN */
                {
                    content: 'SCN',
                    rowSpan: 3,
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* VESSEL NAME COLUMN */
                {
                    content: 'Name of Vessel',
                    rowSpan: 3,
                    styles: {halign: 'center', valign: 'middle', cellWidth: 'auto'}
                },
                /* VOYAGE NO COLUMN */
                {
                    content: 'Voy No.',
                    rowSpan: 3,
                    styles: {halign: 'center', valign: 'middle', cellWidth: 'auto'}
                },
                /* ANCHORAGE COLUMN */
                {
                    content: 'ANCHORAGE',
                    colSpan: 4,
                    styles: {halign: 'center'}
                },
                /* BERTH COLUMN */
                {
                    content: 'BERTH',
                    colSpan: 4,
                    styles: {halign: 'center'}
                },
                /* BERTH ASSIGNMENT */
                {
                    content: 'Berth Assignment',
                    rowSpan: 3,
                    styles: {halign: 'center', valign: 'middle', cellWidth: 'auto'}
                },
                /* PARTICULARS COLUMN */
                {
                    content: 'PARTICULARS',
                    colSpan: 6,
                    rowSpan: 2,
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* PORT OF CALL COLUMN */
                {
                    content: 'Port of Call',
                    colSpan: 2,
                    rowSpan: 2,
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* PASSENGERS COLUMN */
                {
                    content: 'PASSENGERS',
                    colSpan: 2,
                    rowSpan: 2,
                    styles: {halign: 'center', valign: 'middle', cellWidth: 'auto'}
                },
                /* O.R. #/AMT PAID COLUMN */
                {
                    content: 'OFFICIAL RECEIPT NO./ AMOUNT PAID',
                    colSpan: 2,
                    rowSpan: 2,
                    styles: {halign: 'center', valign: 'middle', cellWidth: 'auto'}
                },
                /* NAME AND SIGNATURE COLUMN */
                {
                    content: 'Name & Signature',
                    colSpan: 2,
                    rowSpan: 2,
                    styles: {halign: 'center', valign: 'middle', cellWidth: 'auto'}
                },
                /* ADDITIONAL STAY COLUMN */
                {
                    content: 'ADDITIONAL STAY / NO. OF DAYS',
                    rowSpan: 3,
                    styles: {halign: 'center', valign: 'middle', cellWidth: 'auto'}
                },
                /* ADDITIONAL STAY - O.R. #/AMT PAID COLUMN */
                {
                    content: 'OFFICIAL RECEIPT NO. / AMOUNT PAID (for additional stay)',
                    colSpan: 2,
                    rowSpan: 2,
                    styles: {halign: 'center', valign: 'middle', cellWidth: 'auto'}
                },
                /*  ADDITIONAL STAY - NAME AND SIGNATURE COLUMN */
                {
                    content: 'Name & Signature',
                    colSpan: 2,
                    rowSpan: 2,
                    styles: {halign: 'center', valign: 'middle', cellWidth: 'auto'}
                }

            ],
            [
                /* ANCHORAGE ARRIVAL COLUMN */
                {
                    content: 'Arrival',
                    colSpan: 2,
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* ANCHORAGE DEPARTURE COLUMN */
                {
                    content: 'Departure',
                    colSpan: 2,
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* BERTH ARRIVAL COLUMN */
                {
                    content: 'Arrival',
                    colSpan: 2,
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* BERTH DEPARTURE COLUMN */
                {
                    content: 'Departure',
                    colSpan: 2,
                    styles: {halign: 'center', valign: 'middle'}
                },
            ],
            [
                /* ANCHORAGE ARRIVAL (ATA - DATE & TIME) COLUMN */
                {
                    content: 'Date',
                    styles: {halign: 'center', valign: 'middle'}
                },
                {
                    content: 'Time',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* ANCHORAGE DEPARTURE (ATD - DATE & TIME) COLUMN */
                {
                    content: 'Date',
                    styles: {halign: 'center', valign: 'middle'}
                },
                {
                    content: 'Time',
                    styles: {halign: 'center', valign: 'middle'}
                },

                /* BERTH ARRIVAL (ATA - DATE & TIME) COLUMN */
                {
                    content: 'Date',
                    styles: {halign: 'center', valign: 'middle'}
                },
                {
                    content: 'Time',
                    styles: {halign: 'center', valign: 'middle'}
                },

                /* BERTH DEPATURE (ATD - DATE & TIME) COLUMN */
                {
                    content: 'Date',
                    styles: {halign: 'center', valign: 'middle'}
                },
                {
                    content: 'Time',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* PARTICULARS - GT COLUMN */
                {
                    content: 'GT',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* PARTICULARS - NRT COLUMN */
                {
                    content: 'NRT',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* PARTICULARS - DWT COLUMN */
                {
                    content: 'DWT',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* PARTICULARS - Beam COLUMN */
                {
                    content: 'Beam',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* PARTICULARS - LOA COLUMN */
                {
                    content: 'LOA',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* PARTICULARS - Draft COLUMN */
                {
                    content: 'Draft',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* PORT OF CALL - LAST PORT COLUMN */
                {
                    content: 'Last',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* PORT OF CALL - Next PORT COLUMN */
                {
                    content: 'Next',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* PASSENGERS - IN COLUMN */
                {
                    content: 'In',
                    styles: {halign: 'center', valign: 'middle', cellWidth: 'auto'}
                },
                /* PASSENGERS - OUT COLUMN */
                {
                    content: 'Out',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* O.R. #/AMT PAID - O.R. # COLUMN */
                {
                    content: 'O.R. #',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* O.R. #/AMT PAID - AMT PAID COLUMN */
                {
                    content: 'Amt Paid (PHP)',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* NAME & SIGNATURE - SHIPPING AGENT COLUMN */
                {
                    content: 'Shipping Agent',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* NAME & SIGNATURE - PPA PERSONNEL COLUMN */
                {
                    content: 'PPA Personnel',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* ADDITIONAL STAY - O.R. # COLUMN */
                {
                    content: 'O.R. #',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* ADDITIONAL STAY - AMT PAID COLUMN */
                {
                    content: 'Amt Paid (PHP)',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* ADDTITIONAL STAY - NAME & SIGNATURE SHIPPING AGENT COLUMN */
                {
                    content: 'Shipping Agent',
                    styles: {halign: 'center', valign: 'middle'}
                },
                /* ADDTITIONAL STAY - NAME & SIGNATURE PPA PERSONNEL COLUMN */
                {
                    content: 'PPA Personnel',
                    styles: {halign: 'center', valign: 'middle'}
                }
            ]
        ]
    }
}
/* STYLING OF COLUMNS */
function columnstyles() {
    if (report_class === "standard") {
        return {
            1: {cellWidth: 'wrap'},
            2: {cellWidth: 'wrap'},
            5: {cellWidth: 'auto'},
            6: {cellWidth: 'wrap'},
            7: {cellWidth: 'wrap'},
            8: {cellWidth: 'wrap'},
            9: {cellWidth: 'wrap'},
            10: {cellWidth: 'wrap'},
            11: {cellWidth: 'wrap'},
            12: {cellWidth: 'wrap', halign: 'center', valign: 'middle'},
            13: {cellWidth: 'wrap'},
            14: {cellWidth: 'wrap'},
            15: {cellWidth: 'wrap'},
            16: {cellWidth: 'wrap'},
            17: {cellWidth: 'wrap'},
            18: {cellWidth: 'wrap'},
            19: {cellWidth: 'wrap'},
            20: {cellWidth: 'wrap'},
            21: {cellWidth: 'wrap'},
            22: {cellWidth: 'wrap'},
            23: {cellWidth: 'auto', halign: 'center'},
            24: {cellWidth: 'auto'},
            25: {cellWidth: 'auto'},
            26: {cellWidth: 'auto'},
            27: {cellWidth: 'auto', halign: 'center', valign: 'middle'},
            28: {cellWidth: 'auto'},
            29: {cellWidth: 'auto'},
            30: {cellWidth: 'wrap'},
            31: {cellWidth: 'wrap'},
            34: {cellWidth: 'auto'},
            35: {cellWidth: 'auto', halign: 'center'},
            36: {cellWidth: 'wrap', overflow: 'linebreak'},
            37: {cellWidth: 'wrap', overflow: 'linebreak'},
            38: {cellWidth: 'auto', halign: 'center'},
            40: {cellWidth: 'auto', halign: 'center'},
            41: {cellWidth: 'wrap', overflow: 'linebreak'},
            42: {cellWidth: 'wrap', overflow: 'linebreak'}
        }
    } else if (report_class === "internal") {
        return {
            1: {cellWidth: 'wrap'},
            2: {cellWidth: 'wrap'},
            3: {cellWidth: 'auto'},
            4: {cellWidth: 'wrap'},
            5: {cellWidth: 'wrap'},
            6: {cellWidth: 'wrap'},
            7: {cellWidth: 'auto'},
            15: {cellWidth: 'auto', halign: 'center'},
            26: {cellWidth: 'wrap'},
            27: {cellWidth: 'wrap'},
            28: {cellWidth: 'wrap', overflow: 'linebreak'},
            29: {cellWidth: 'wrap', overflow: 'linebreak'},
            30: {cellWidth: 'auto', halign: 'center'},
            31: {cellWidth: 'wrap'},
            32: {cellWidth: 'wrap'},
            34: {cellWidth: 'wrap', overflow: 'linebreak'},
            35: {cellWidth: 'wrap', overflow: 'linebreak'},
        }
    }

}
/* FORMAT DATE TO mm/dd/yyyy */
function getFormattedDate(rawdate) {
    var date = new Date(rawdate);
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var day = date.getDate();
    month = (month < 10 ? "0" : "") + month;
    day = (day < 10 ? "0" : "") + day;
    var formatted_date = month + "/" + day + "/" + year;
    return formatted_date;
}
/* FORMAT TIME TO h:i / 24 HOUR FORMAT */
function getFormattedTime(rawdate) {
    var date = new Date(rawdate);
    var hours = date.getHours();
    var minutes = date.getMinutes();
    //  var ampm = hours >= 12 ? 'pm' : 'am';
    // hours = hours % 12;
    //  hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0' + minutes : minutes;
    // var formatted_time = hours + ':' + minutes + ' ' + ampm.toUpperCase();
    var formatted_time = hours + ':' + minutes;
    return formatted_time;
}
/* FORMAT MONTH TO FULL MONTH NAME AND YEAR */
function getFormattedMonth(rawmonth) {
    const date = new Date(rawmonth);
    var year = date.getFullYear();
    const formmated_month = date.toLocaleString('default', {month: 'long'}) + " " + year;
    return formmated_month;
}
/* FORMAT IMAGE TO BASE 64 */
function imgToBase64(src, callback) {
    var outputFormat = src.substr(-3) === 'png' ? 'image/png' : 'image/jpeg';
    var img = new Image();
    img.crossOrigin = 'Anonymous';
    img.onload = function () {
        var canvas = document.createElement('CANVAS');
        var ctx = canvas.getContext('2d');
        var dataURL;
        canvas.height = this.naturalHeight;
        canvas.width = this.naturalWidth;
        ctx.drawImage(this, 0, 0);
        dataURL = canvas.toDataURL(outputFormat);
        callback(dataURL);
    };
    img.src = src;
    if (img.complete || img.complete === undefined) {
        img.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
        img.src = src;
    }
}
/* FORMAT CURRENCY TO TWO DECIMAL PLACES AND COMMA FOR THOUSANDS */
function format_currency(amt) {
    var parse_amt = parseFloat(amt);
    var format_amt = (parse_amt).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    return format_amt;
}
/* GLOBAL VARIABLES */
var baseurl = $('#baseurl').val(); // GET BASEURL
var typeofport = $('#typeofport').val(); //GET TYPE OF PORT
var captypeofport = $('#captypeofport').val(); // GET CAPITALIZE WORD OF TYPE OF PORT
var daily_report = $('#daily_report').val();
var weekly_from = $('#week_from').val();
var weekly_to = $('#week_to').val();
var monthly_report = $('#monthly_report').val();
var yearly_report = $('#selected_year').val();
var report_class = $('#report_class').val();
var logo_src = baseurl + "assets/images/logos/ppanewlogo.png";
var w = 0, x = 0, y = 0, z = 0; // FOR LOOPING OF IMAGES 
var client_signatures = [], ppa_signatures = [], client_addstaysign = [], ppa_addstaysign = [], final_clientsign = [];
var logo;
// ARRAY FOR ALL IMAGE SIGNATURES 
/* DOCUMENT READY FUNCTION */
$(document).ready(function () {
    focus_particulars(); // call focus_particular function
    focus_addstay(); // call focus on additional stay function
    focus_berth(); // call focus on berth function
    get_years();
    focus_additionalstay();
    /* SET VESSEL LOG - TRANSACTIONS TABLE */
    $('#vessel_table').DataTable({
        "scrollY": 500,
        "scrollX": true,
        scrollCollapse: true,
        paging: false,
        fixedColumns: {
            leftColumns: 8
        },
        "responsive": true,
        stateSave: true,
    });
    /* SET VESSEL LOG - VESSEL DETAILS TABLE */
    $('#vessel_details').DataTable({
        "scrollY": 500,
        "scrollX": true,
        scrollCollapse: true,
        paging: false,
        fixedColumns: {
            leftColumns: 5
        },
        "responsive": true,
        stateSave: true,
    });
    $('#user_details').DataTable({
        "scrollY": 500,
        "scrollX": true,
        scrollCollapse: true,
        paging: false,
        "responsive": true,
        stateSave: true,
    });
    /* SET REPORTORIAL TABLE*/
    $('#standard_report').DataTable({
        "scrollY": 500,
        "scrollX": true,
        scrollCollapse: true,
        paging: false,
        fixedColumns: {
            leftColumns: 4
        },
        "responsive": true,
        stateSave: true,
    });
    $('#internal_report').DataTable({
        "scrollY": 500,
        "scrollX": true,
        scrollCollapse: true,
        paging: false,
        fixedColumns: {
            leftColumns: 7
        },
        "responsive": true,
        stateSave: true,
    });
    $("#updatetransac").submit(function (e) {
        var berth_atd = $('#berth_atd').val();
        var additional_stay = $('#addnumstay').val();
        var ornum_addstay = $('#ornumaddstay').val();
        var payment_addstay = $('#paymentaddstay').val();
        if (!berth_atd) {
            e.preventDefault();
            $('#berth_atd').prop('required', true);
        }
        if (additional_stay) {
            if (!ornum_addstay) {
                $('#ornumaddstay').prop('required', true);
            }
            if (!payment_addstay) {
                $('#paymentaddstay').prop('required', true);
            }
            if (!$('#add_approvedoption').is(':checked')) {
                e.preventDefault();
                $('#add_approvedoption').prop('required', true);
            }
        }
    });
    /* DISPLAY THE NAME OF FILE UPON FILE UPLOAD OF PROFILE PICTURE */
    $('#profilepic').on('change', function (e) {
//get the file name
        var fileName = e.target.files[0].name;
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    });
    /* DISPLAY THE NAME OF THE FILE UPON FILE UPLOAD OF SIGNATURE */
    $('#signature').on('change', function (e) {
//get the file name
        var fileName = e.target.files[0].name;
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    });
    /* SET REPORTORIAL TABLE*/
    $('.standard-pdf').on('click', function (e) {
        e.preventDefault();
        generatereport();
    });
    $('.internal-pdf').on('click', function (e) {
        e.preventDefault();
        generatereport();
    });
    /* DISPLAY OR HIDE SEARCH/FILTER BY ETD */
    $('#typeofmovement').on('change', function (e) {
        var typeofmovement = $(this).val();
        if (typeofmovement === "berth") {
            $('.etd_div').show();
        } else {
            $('.etd_div').hide();
        }
    });
    $('input[name="addapprovedoption"]').change(function () {
        if ($("#add_approvedoption").is(':checked')) {
            $('#add_approvedoption').attr('required', true);
        } else {
            $('#add_approvedoption').removeAttr('required');
        }
    });
    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
    });
    // scroll body to 0px on click
    $('#back-to-top').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 400);
        return false;
    });
}
);