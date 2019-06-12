 <div class="main_menu">
        <ul>
            <li>
                File
                <ul class="sub-menu">
                    <li>
                        Recipts
                        <ul class="sub-sub-menu">
                            <li><a class="nav-bar-links" href="#" data-reveal-id="creatrecipt">New Patient Reciept</a></li>
                        </ul>
                    </li>
                    <li>
                        Reports
                        <ul class="sub-sub-menu">
                            <li>Partial Reports</li>
                            <li>Completed Reports</li>
                            <li>Report Due in 1hr</li>
                            <li>Report Delivery</li>
                        </ul>
                    </li>
                    <li>Result Entry</li>
                    <li>Varify Results</li>
                    <li>Upload Recipts</li>
                    <li>Change Pasword</li>
                    <li>Lock Screen</li>
                    <li onclick="window.location.href='<?php echo $ru;?>process/logout.php'" style="cursor:pointer;">Log out</li>
                    <li>Exit</li>
                </ul>
            </li>
            <li>
                Reciption
                <ul class="sub-menu">
                    <li>
                        Income
                        <ul class="sub-sub-menu">
                            <li><a href="#" data-reveal-id="new_shift_income">New Shift Income</a></li>
                            <li>All Handover Income</li>
                            <li onclick="ajaxfuction('incomeReport')" style="cursor:pointer;">Income Report</li>
                        </ul>
                    </li>
                    <li>
                        Expense
                        <ul class="sub-sub-menu">
                            <li>New Daily Expense</li>
                            <li>Expense Report</li>
                            <li>Sale/Expense Report</li>
                            <li onclick="ajaxfuction('alldailyexpence')" style="cursor:pointer;">All daily Expenses</li>
                        </ul>
                    </li>
                    <li>
                        Recipts
                        <ul class="sub-sub-menu">
                            <li>New Reciepts</li>
                            <li>Search Reciepts</li>
                            <li>All Patient Reciepts</li>
                        </ul>
                    </li>
                    <li>
                        Others
                        <ul class="sub-sub-menu">
                            <li>Panel Report</li>
                            <li>Patient Dues</li>
                            <li>Patient Clear Dues</li>
                            <li>Specimen Due</li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                View
                <ul class="sub-menu">
                    <li>
                        Left Panel
                    </li>
                </ul>
            </li>
            <li>
            	Accounts
                <ul class="sub-menu">
                    <li>
                        Shift Income
                        <ul class="sub-sub-menu">
                            <li>All Shift Income</li>
                        </ul>
                    </li>
                    <li>
                        Employee Salary
                        <ul class="sub-sub-menu">
                            <li>Employee Salary</li>
                            <li>All Employee Salary</li>
                        </ul>
                    </li>
                    <li>
                        Employee Advance
                        <ul class="sub-sub-menu">
                            <li>Employee Advances</li>
                            <li>All Employee Advances</li>
                        </ul>
                    </li>
                    <li>
                        Employee Increment
                        <ul class="sub-sub-menu">
                            <li>Employee Increment</li>
                            <li>All Employee Increments</li>
                        </ul>
                    </li>
                    <li>
                        Bank Accounts
                        <ul class="sub-sub-menu">
                            <li>Bank Account</li>
                            <li>All Bank Accounts</li>
                        </ul>
                    </li>
                    <li>
                        Account Trancsactions
                        <ul class="sub-sub-menu">
                            <li>Account Trancsaction</li>
                            <li>All Account Trancsactions</li>
                        </ul>
                    </li>
                    <li>
                        Utililty Bills
                        <ul class="sub-sub-menu">
                            <li>Utililty Bill</li>
                            <li>All Utililty Bills</li>
                            <li>Bill Type</li>
                            <li>All Bill Types</li>
                            <li>Meter</li>
                            <li>All Meters</li>
                        </ul>
                    </li>
                    <li>
                        Panel Bills
                        <ul class="sub-sub-menu">
                            <li>Panel Bill Submit</li>
                            <li>All Panel Bills Submited</li>
                            <li>Panel Bill Receive</li>
                            <li>All Panel Bill Received</li>
                            <li>Commission Bill Paid</li>
                            <li>All Commission Bill Paid</li>
                        </ul>
                    </li>
                    
                </ul>
            </li>
            <li>
            	Store
                <ul class="sub-menu">
                    <li>
                        Items
                        <ul class="sub-sub-menu">
                            <li>
                            	<a class="nav-bar-links" href="#" data-reveal-id="addnewitem">New Item</a>    
                            </li>
                            <li  onclick="ajaxfuction('all_items')" style="cursor:pointer;">All Items</li>
                            <li>Add Item</li>
                            <li>All Added Items</li>
                            <li>Issue Item</li>
                            <li>All Issued Items</li>
                        </ul>
                    </li>
                    <li>
                        Kit
                        <ul class="sub-sub-menu">
                            <li>New Kit</li>
                            <li>All Kit</li>
                            <li>Add Kit</li>
                            <li>All Added Kits</li>
                            <li>Issue Kit</li>
                            <li>All Issued Kits</li>
                            <li>All Kits Stock Balence</li>
                        </ul>
                    </li>
                    <li>
                        Supplier
                        <ul class="sub-sub-menu">
                            <li>
                            	<a class="nav-bar-links" href="#" data-reveal-id="newsupplier">New Supplier</a>
                            </li>
                            <li onclick="ajaxfuction('suppliers')" style="cursor:pointer;">All Suppliers</li>
                            <li>Supplier Dues</li>
                            <li>All Supplier Dues</li>
                            <li>Supplier Reports</li>
                        </ul>

                    </li>
                    <li>
                        Company
                        <ul class="sub-sub-menu">
                            <li>
                            	<a class="nav-bar-links" href="#" data-reveal-id="newcompany">New Company</a>
                            </li>
                            <li  onclick="ajaxfuction('companies')" style="cursor:pointer;">All Companies</li>
                        </ul>
                    </li>
                    <li>
                        Instruments
                        <ul class="sub-sub-menu">
                            <li>New Instrument</li>
                            <li>All Instruments</li>
                        </ul>
                    </li>
                    <li>
                        Orders
                        <ul class="sub-sub-menu">
                            <li>New Order</li>
                            <li>All New Orders</li>
                            <li>All Orders Details</li>
                            <li>Order Recieved</li>
                            <li>All Orders Recieved</li>
                        </ul>
                    </li>
                    <li>
                        Purchases
                        <ul class="sub-sub-menu">
                            <li>New Purchase</li>
                            <li>All Purchases</li>
                            <li>Purchase Detail</li>
                            <li>All Purchase Detail</li>
                        </ul>
                    </li>
                    <li>
                        Demands
                        <ul class="sub-sub-menu">
                            <li>All Demand</li>
                            <li>New Demand</li>
                        </ul>
                    </li>
                    </ul>
            </li>
            <li>
            	Extras
                 <ul class="sub-menu">
                    <li onclick="firstletter('a','tbladdressbook')" style="cursor:pointer;">
                        Address Book
                    </li>
                    <li>
                         <a class="nav-bar-links" href="#" data-reveal-id="new_ab_category">New Address Book Category</a>   
                    </li>
                    <li onclick="ajaxfuction('add_book_cat')" style="cursor:pointer;">
                        All Address Book Categories
                    </li>
                 </ul>
            </li>
            <li>
            	System
                <ul class="sub-menu">
                    <li>
                        Employee
                        <ul class="sub-sub-menu">
                            <li>
                               <a class="nav-bar-links" href="#" data-reveal-id="newemployee">New Employee</a>     
                            </li>
                            <li onclick="ajaxfuction('tblemployee')" style="cursor:pointer;">
                                All Employees
                            </li>
                       </ul>
                    </li>
                    <li>
                        Category2
                        <ul class="sub-sub-menu">
                            <li>
                                <a class="nav-bar-links" href="#" data-reveal-id="newcategory2">New Category 2</a>
                            </li>
                            <li onclick="ajaxfuction('tblcategories')" style="cursor:pointer;" >
                                All Categories 2
                            </li>
                       </ul>
                    </li>
                    <li>
                        Category
                        <ul class="sub-sub-menu">
                            <li>
                                New Category
                            </li>
                            <li>
                                All Categories
                            </li>
                       </ul>
                    </li>
                    <li>
                        Department
                        <ul class="sub-sub-menu">
                            <li>
                                <a class="nav-bar-links" href="#" data-reveal-id="testdepartment"> New Department</a>
                            </li>
                            <li onclick="ajaxfuction('tbltestdepartments')" style="cursor:pointer;">
                                All Departments
                            </li>
                       </ul>
                    </li>
                    <li>
                        Tests
                        <ul class="sub-sub-menu">
                            <li>
                                <a class="nav-bar-links" href="#" data-reveal-id="newtest">New Tests</a>
                            </li>
                            <li onclick="firstletter('a','tbltest')" style="cursor:pointer;">
                                All Tests
                            </li>
                       </ul>
                    </li>
                    <li>
                        Specimen
                        <ul class="sub-sub-menu">
                            <li>
                                <a class="nav-bar-links" href="#" data-reveal-id="newspecimen">New Specimen</a>
                            </li>
                            <li onclick="ajaxfuction('tblspecimens')" style="cursor:pointer;">
                                All Specimens
                            </li>
                       </ul>
                    </li>
                    <li>
                        Organisms
                        <ul class="sub-sub-menu">
                            <li>
                                <a class="nav-bar-links" href="#" data-reveal-id="neworganism">New Organisms</a>
                            </li>
                            <li  onclick="ajaxfuction('tblorganisms')" style="cursor:pointer;">
                                All Organisms
                            </li>
                       </ul>
                    </li>
                    <li>
                        Antibiotics
                        <ul class="sub-sub-menu">
                            <li>
                                <a class="nav-bar-links" href="#" data-reveal-id="newantibiotec">New Antibiotics</a>
                            </li>
                            <li onclick="ajaxfuction('tblAntibiotics')" style="cursor:pointer;" >
                                All Antibiotics
                            </li>
                       </ul>
                    </li>
                    <li>
                        TestNotes
                        <ul class="sub-sub-menu">
                            <li>
                                <a class="nav-bar-links" href="#" data-reveal-id="newtestnote">New TestNotes</a>
                            </li>
                            <li onclick="ajaxfuction('tbltestnotes')" style="cursor:pointer;">
                                All TestNotes
                            </li>
                       </ul>
                    </li>
                    <li>
                        Machines
                        <ul class="sub-sub-menu">
                            <li>
                                <a class="nav-bar-links" href="#" data-reveal-id="newmachine">New Machines</a>
                            </li>
                            <li onclick="ajaxfuction('tblmachinedetails')" style="cursor:pointer;">
                                All Machines
                            </li>
                       </ul>
                    </li>
                    <li>
                        Referred By
                        <ul class="sub-sub-menu">
                            <li>
                                 <a class="nav-bar-links" href="#" data-reveal-id="refferedby">New Referred</a>
                            </li>
                            <li onclick="ajaxfuction('tblreferreddoctor')" style="cursor:pointer;">
                                All Referred
                            </li>
                       </ul>
                    </li>
                    <li>
                        Panel
                        <ul class="sub-sub-menu">
                            <li>
                                <a class="nav-bar-links" href="#" data-reveal-id="paneldiv">New Panel</a>
                            </li>
                            <li onclick="ajaxfuction('tblpaneldetails')" style="cursor:pointer;">
                                All Panel
                            </li>
                       </ul>
                    </li>
                    <li>
                        Points
                        <ul class="sub-sub-menu">
                            <li>
                                 <a class="nav-bar-links" href="#" data-reveal-id="newpoint">New Point</a>
                            </li>
                            <li onclick="ajaxfuction('tblpoints')" style="cursor:pointer;">
                                All Points
                            </li>
                       </ul>
                    </li>
                    <li>
                        Roles
                        <ul class="sub-sub-menu">
                            <li>
                                <a class="nav-bar-links" href="#" data-reveal-id="newrole">New Role</a>
                            </li>
                            <li onclick="ajaxfuction('tblroles')" style="cursor:pointer;">
                                All Roles
                            </li>
                       </ul>
                    </li>
                    <li>
                        Rights
                        <ul class="sub-sub-menu">
                            <li onclick="alert('Right Persisted Successfully')" style="cursor:pointer;">
                                Persist Rights
                            </li>
                            <li onclick="ajaxfuction('tblrights')" style="cursor:pointer;">
                                All Rights
                            </li>
                       </ul>
                    </li>
                    <li>
                        ExpenseTypes
                        <ul class="sub-sub-menu">
                            <li onclick="ajaxfuction('tblexpensetype')" style="cursor:pointer;">
                                All ExpenseTypes
                            </li>
                       </ul>
                    </li>
                    <li>
                        Specimen Bottles
                        <ul class="sub-sub-menu">
                            <li>
                                <a class="nav-bar-links" href="#" data-reveal-id="newbottle">New Bottle</a>
                            </li>
                            <li onclick="ajaxfuction('tblspecimenbottles')" style="cursor:pointer;">
                                All Bottles
                            </li>
                       </ul>
                    </li>
                    <li onclick="ajaxfuction('DepSequnceNo')" style="cursor:pointer;">
                        Department Sequence No.
                    </li>
                    <li>
                        Preferences
                    </li>
                    <li>
                        Exceptions
                    </li>
                 </ul>
            </li>
            <li>
            	Report
                <ul class="sub-menu">
                 	 <li>
                         Employee
                         <ul class="sub-sub-menu">
                            <li onclick="ajaxfuction('salesreport')" style="cursor:pointer;">
                                Sales Report
                            </li>
                         </ul> 
                     </li>
                     <li>
                         Employee Salary Slip   
                     </li>
                     <li>
                         All Petient Dues    
                     </li>
                     <li>
                         Panel Bills
                         <ul class="sub-sub-menu">
                            <li>
                                Panel Bills Submit
                            </li>
                            <li>
                                Panel Bills Receive
                            </li>
                         </ul>     
                     </li>
                     <li>
                         Sample recieved 
                     </li>
                 </ul>
            </li>
            <li>
            	Help
                <ul class="sub-menu">
                 	 <li>
                         Help Contents
                     </li>
                     <li>
                         About
                     </li>
                </ul>
            </li>
        </ul>
    </div>
    <!--Main Menu Ends Here-->
    <div class="shortcut_icons">
        <ul>
            <li><a class="nav-bar-links" href="#" data-reveal-id="creatrecipt"><img src="<?php echo $ru;?>images/savebutton.png" /></a></li>
            <li><img src="<?php echo $ru;?>images/file.png" />|</li> 
            <li><img src="<?php echo $ru;?>images/keys.png" /></li> 
            <li><img src="<?php echo $ru;?>images/lock.png" /></li> 
            <li><img src="<?php echo $ru;?>images/users.png" />|</li>
            <li><img src="<?php echo $ru;?>images/home.png" />|</li> 
            <li><img src="<?php echo $ru;?>images/close.png" /></li> 
        </ul>
    </div>
    <div style="clear:both"></div>