<div id="items">
    <div id="items-in">
 <h2 style="font-family:Century Gothic;">Enter the details to sign up</h2>
                <table>
                    <form name="user_signup" action="process/process_user.php" method="post" id="signup_form" class="well span5" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="add_user" />
                        <tr>
                            <td>
                                <label>Full Name:</label>
                            </td>
                            <td>
                                <input type="text" name="full_name" required="required" rel="popover" data-content="What is you name?"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Nic. Number:</label>
                            </td>
                            <td>
                                <input type="text" name="nic_num" required="required" data-mask="99999-9999999-9" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Shop Name:</label>
                            </td>
                            <td>
                                <input type="text" name="shop_name" required="required" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Location:</label>
                            </td>
                            <td>
                                <input type="text" name="location" required="required" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>User email:</label>
                            </td>
                            <td>
                                <input type="email" name="email" required="required"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Password:</label>
                            </td>
                            <td>
                                <input type="password" name="user_password" required="reqiuired" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Confirm Password:</label>
                            </td>
                            <td>
                                <input type="password" name="c_pass" required="required" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Phone:</label>
                            </td>
                            <td>
                                <input type="text" name="user_phone" required="required"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Picture:</label>
                            </td>
                            <td>
                                <input type="file" name="user_img" required/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" value="Submit" class="btn btn-primary" />
                            </td>
                            <td>
                                <input type="Reset" value="Cancel"  class="btn btn-danger"/>
                            </td>
                        </tr>
                        
                    </form>
                </table>
    </div>
</div>