<section class="contact">
    <div class="container">
        <div class="row">
            <div style="margin: auto; display: block; width: 500px">
                <div>
                    <form onsubmit="return validateEmail();" method="post">
                        <input type="hidden" name="send">
                        <h2>Contact Us</h2><br>
                        <div class="modal">
                            <label for="name">Full name*</label>
                            <span class="input"><input type="text" name="name" id="name" onblur="validateName()" placeholder="Your Full Name" required></span>
                            <label for="email">
                                Email*<br>
                            </label>
                            <span class="input"><input type="email" name="email" id="email" onblur="validateEmail()" placeholder="name@email.com" required></span>
                            <label for="message">
                                Message*<br>
                            </label>
                            <span class="input"><textarea name="message" id="message" rows="7" placeholder="Enter your message." required></textarea></span>
                            <button type="submit" class="submitbutton">
                                Submit
                            </button>
                        </div>
                        <span style="float: right; width: 100%"><br>We will get back to you within 3 working days.</span>
                    </form>
                </div>
                <div style="line-height: 160%; float: center">
                    <section id="shipping">
                        <h3><a href="#shipping" class="buttontext"><br><br><br>Shipping Information</a></h3><br>
                        <table class="u-fill">
                            <tr class="tablerow">
                                <th>
                                    Delivery Type
                                </th>
                                <th>
                                    Price
                                </th>
                                <th>
                                    Estimated Time
                                </th>
                                <th>
                                    Availablity
                                </th>
                            </tr>
                            <tr class="tablerow">
                                <td>
                                    Home Delivery
                                </td>
                                <td>
                                    $6.00
                                </td>
                                <td>
                                    3 - 5 working days
                                </td>
                                <td>
                                    <span>Weekdays only</span><br>
                                    <span>Not available on Public Holidays</span><br>
                                    <span>Within Singapore only</span>
                                </td>
                            </tr>
                        </table>
                    </section>
                    <section id="policy"><br><br>
                        <h3><a href="#policy" class="buttontext">Our Return Policy</a></h3><br>
                        <p>
                            Within 14 days of the order being received, you can return any shoes <b>in saleable
                            condition</b>.
                        </p>
                        <p>
                            To process your return, please contact our customer center at +65 6666 6666 or
                            email to f32ee@localhost.
                        </p>
                    </section>
                </div>
            </div>
        </div>
    </div>
</section>