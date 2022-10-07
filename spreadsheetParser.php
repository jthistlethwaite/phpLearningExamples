<?php
/**
 * Load a CSV file as an array so the data can be processed.
 *
 * This example serves as a skeleton for how to load a CSV file with PHP so
 * something can be done with the contents. Typical real-world uses revolve
 * around parsing spreadsheets to import them into a database, input
 * instructions to a system, or perform calculations that Excel isn't useful
 * for.
 *
 * A real world scenario might be an ecommerce store who needs to purchase
 * shipping for a bunch of customer orders. Each row in a spreadsheet might
 * represent one order needing shipped, and include something like the name
 * and address of the customer. In that case, a method similar to what is
 * shown here may be used to load that spreadsheet so a program can buy
 * shipping for each of the orders.
 *
 * Of note:
 * This example only works with CSV files, and it does not include any method
 * to check whether or not the specified file is actually in CSV format. If
 * someone ran this with a .xlsx file for instance, this script would not
 * work correctly.
 */

$spreadsheetFile = 'test.csv';
if ( !file_exists($spreadsheetFile) ) {
	throw new Exception("The file $spreadsheetFile does not exist.");
}


// If true, the first row of the spreadsheet is labels for the columns
// The result will be each row loaded as an associative array, with array keys the same as the column names
$firstRowIsColumnHeaders = true;

// open the file for reading and throw and exception if that doesn't work
$sheetHandle = fopen($spreadsheetFile, "r");
if ($sheetHandle === false) {
	throw new Exception("Cannot open $spreadsheetFile");
}

// Will hold the names of the columns, if $firstRowIsColumnHeaders is true
$columns = [];

// Will be a multi-dimensional array containing the spreadsheet after we load it
$loadedSheet = [];

// count what row we're on
$rowNum = 0;

// read one line at a time from the file until we reach the end
while ( $row = fgetcsv($sheetHandle) ) {

	// Figure out the name of each column
	if ( $rowNum == 0 && $firstRowIsColumnHeaders ) {
		foreach ($row as $columnName) {
			$columns[] = $columnName;
		}
		$rowNum++;
		continue; // skip executing the rest of this block if we were determining column names
	}

	// will contain the current row after we load/parse it
	$loadedRow = [];

	// loop through each column in the current row
	// colNum will be the number of column, counting left to right, starting at 0 for the first column
	// value will be the contents of the cell
	foreach ($row as $colNum => $value) {


		if ( $firstRowIsColumnHeaders ) {
			// store the cell contents as an associative array, named after the columns


			// determine the name of the column, using the map we built while parsing the first line of the file
			$columnName = $columns[ $colNum ];

			$loadedRow[ $columnName ] = $value;

		} else {
			// we don't have named columns, so store the data based on the column number
			$loadedRow[] = $value;
		}

	}

	// append the row we just read to the loaded data
	$loadedSheet[] = $loadedRow;
	$rowNum++;
}

// close the spreadsheet; we've loaded it now, so we don't need to read from it anymore
fclose($sheetHandle);

// show the results of loading the spreadsheet
print_r($loadedSheet);

