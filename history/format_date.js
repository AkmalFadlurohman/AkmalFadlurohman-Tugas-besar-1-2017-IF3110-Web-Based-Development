function format_date(order_date) {
	var day;
	switch (order_date.getDay()) {
		case 0:
			day = "Sunday";
			break;

		case 1:
			day = "Monday";
			break;

		case 2:
			day = "Tuesday";
			break;

		case 3:
			day = "Wednesday";
			break;

		case 4:
			day = "Thursday";
			break;

		case 5:
			day = "Friday";
			break;

		case 6:
			day = "Saturday";
			break;

		default:
			day = "Error: day out of range";
			break;
	}

	var month;
	switch (order_date.getMonth()) {
		case 0:
			month = "January";
			break;

		case 1:
			month = "February";
			break;

		case 2:
			month = "March";
			break;

		case 3:
			month = "April";
			break;

		case 4:
			month = "May";
			break;

		case 5:
			month = "June";
			break;

		case 6:
			month = "July";
			break;

		case 7:
			month = "August";
			break;

		case 8:
			month = "September";
			break;

		case 9:
			month = "October";
			break;

		case 10:
			month = "November";
			break;

		case 11:
			month = "December";
			break;

		default:
			month = "Error: month out of range";
			break;
	}

	var dateSuffix;
	switch (order_date.getDate) {
		case 1:
			dateSuffix = "st";
			break;

		case 2:
			dateSuffix = "nd";

		case 3:
			dateSuffix = "rd";

		case 21:
			dateSuffix = "st";

		case 23:
			dateSuffix = "nd";
			break;

		case 23:
			dateSuffix = "rd";
			break;

		case 31:
			dateSuffix = "st";
			break;

		default:
			dateSuffix = "th";
			break;
	}


	return (day + ", " + month + " " + order_date.getDate() + dateSuffix + " " + order_date.getFullYear());
};