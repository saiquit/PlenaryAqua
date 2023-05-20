<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdditionalPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages_data')->insert([
            'name' => 'terms',
            'en'   => "<p class='lead text-justify' style='line-height: 2.5rem;' >Plenary is the mother company of Plenary Aqua, and it stands for fish and meat product supply company. As a visitor to the site or as a customer, you are advised to read the terms and conditions carefully. Your access to and use of the service are conditioned on your acceptance of and compliance with these terms and conditions. These Terms apply to all visitors, users, and others who access or use the Service.
            </p><br><h3>Eligibility</h3><p class='lead text-justify' style='line-height: 2.5rem;'>Services of the site would be available at selected geographies & period which is mentioned on the website/ Facebook Page. The persons who are 'incompetent to contract' within the meaning of the Bangladesh Contract Act 1872 including un-discharged insolvents etc. are not eligible to use the website. If you are a minor i.e., under the age of 18 years but at least 13 years of age you may use the website under the parental guidelines and the parent / legal guardian agrees to be bound by these terms of use and parents / legal guardians can transact on behalf of you for the products & service. If you are a minor, you are prohibited from purchasing any materials which are for adult consumption and the sale of which to minors is prohibited.
        </p><br><br><h3>Pricing, Quantity & Quality</h3><br><p class='lead text-justify' style='line-height: 2.5rem;'>The Plenary Aqua team will set the prices for all the items offered on the website. We make sure that the cost is competitive with the market. Delivery will be charged at the pricing specified at the time of purchase. All of our products that are displayed on the website have undergone our best efforts to accurately reflect their genuine color tones. A few of the delivered products, however, may change from the presented image because the actual color tone you see relies on your monitor and we can\'t guarantee the same outcome on all monitors. We promise to provide the highest-quality goods in the specified quantity. If you have any problems, please contact the customer service center with supporting documentation, and we will take the appropriate action to address them within 24 hours, offering a replacement or a refund depending on the client\'s preference.
        </p><br><br><h3>Modes of payment</h3><br><p class='lead text-justify' style='line-height: 2.5rem;'>We accept the payments on these modes: 1. Cash On Delivery (COD), 2. bKash, 3. Nagad, 4. Specific Bank Account provide by us. We strongly advise you to review the Privacy Policy of these websites. We have no control over, and assume no responsibility for the content, privacy policies, or practices of any third-party sites or services.
        </p><br><br><h3>Cancellation</h3><br><p class='lead text-justify' style='line-height: 2.5rem;'> As a customer, you have the right to cancel your order anytime up to the cut-off time of the slot in which you have placed an order by canceling on the website or the app or calling our customer service. In the event that you made payment for the order, we will refund the same.
        Order cancellation at the cut-off time and at the time of delivery is not entertained; if the delivery is delayed, customers have the option to reschedule or cancel the delivery. As a service provider, we have sole discretion to cancel any orders suspected of fraudulent transactions or any orders or customers that defy the terms and conditions of using the service. For accountability, we will maintain the data regarding all the negative listed transactions and customers, and if needed, we will share the same with legal or concerned entities for further proceedings.
        </p><h3>Information Collection and Use</h3><br><p class='lead text-justify' style='line-height: 2.5rem;' >Your name, including first and last name, email address, address, phone number, postal code, demographic profile (age, gender, occupation, address, etc.), information about the pages on the website you visit or access, the links you click on the website, the number of times you access the pages, and browsing information may be requested of you in order to improve your experience while using our service. Depending on the website, the data we collect is either stored on your device or on our secure servers. The data received is utilized to deliver and enhance the service. Except as stated in this privacy statement, your information will not be used or shared by us with anyone else. The terms used in this Privacy Policy have the same meanings as in our Terms and Conditions, which is accessible at the website, unless otherwise defined in this Privacy Policy.
            </p><br><br><h3>Children's Privacy</h3><br><p class='lead text-justify' style='line-height: 2.5rem;'>Anyone under the age of 13 is not eligible for these services. Children under 13 are not intentionally subjected to our collection of personally identifying information. When we become aware that a child under the age of 13 has given us personal information, we immediately remove it from our servers. Please get in touch with us if you\'re a parent or guardian and you know that your child has given us personal information so that we can take the appropriate measures.
            </p><br><br><h3>License & Site Access</h3><br><p class='lead text-justify' style='line-height: 2.5rem;'>Plenary Aqua grants you limited access and use of the website, and you are not to download or modify it or any portion of it except with written or electronic consent from Plenary Aqua. This doesn\'t include any resale or commercial use of the website or its contents; any collection and use of any product listings, descriptions, or prices; any derivative use of the website or its contents; any downloading, copying, or recording of any form information (including any type of media, text, page layout, or form) for any purpose. The website or any portion of Plenary Aqua may not be reproduced, duplicated, copied, sold, resold, visited, or otherwise exploited for any commercial purpose without written or electronic consent from Plenary Aqua. Any unauthorized use terminates the permission or license granted by Plenary Aqua; severe breaches or disrupting behaviors may entail legal proceedings.
            </p><br><br><h3>Security</h3><br><p class='lead text-justify' style='line-height: 2.5rem;'>
        We value your trust in providing us your Personal Information, thus we are striving to use commercially acceptable means of protecting it. But remember that no method of transmission over the internet, or method of electronic storage is 100% secure and reliable, and we cannot guarantee its absolute security.
        </p><br><br><h3>Updates to This Privacy Policy</h3><br><p class='lead text-justify' style='line-height: 2.5rem;'>
        Plenary Aqua may update the Terms and Conditions of Use of the website from time to time. Thus, you are advised to review this page periodically for any changes. In the event the updated terms and conditions are not acceptable to you, you may discontinue using the service; however, if you continue to use the service, you shall be deemed to have agreed to accept and continue with the updated terms and conditions. The changes are effective immediately after they are posted on this page.
        </p>
           ",
            'bn'   => "",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        DB::table('pages_data')->insert([
            'name' => 'about',
            'en'   => "Plenary Aqua is an emerging institution that deals with fish and fisheries. It was founded by a group of fisheries graduates from Khulna University. The main purpose of Plenary Aqua is to deliver the best-quality fish, crab, and other fisheries products to people who are looking for safe and quality protein items.
            <br><br>Plenary Aqua is already working in the aquaculture field with raw and ready-to-cook fish and crab products. And it has covered the maximum area of Bangladesh in terms of fish and crab delivery. It is committed to delivering fish and crab directly from farmers without any extra hands so that farmers can generate a good amount of profit from this.
            <br><br>In addition, as the farmers we utilize for fish collecting also keep chickens and ducks, we also start out with ready-to-cook duck and deshi chicken. Therefore, we gather them, cut and clean them, and then deliver them to our customers. We believe that this will lead text-justify to substantial local demand and draw attention to innovation.
            <br><br>Perhaps our goal is to link aquaculture to all related businesses, opening up the market to both forward and backward links. Plenary Aqua intends to join the domestic market with a sophisticated way of supplying fish, crab, and meat, with the objective of providing adequately preserved, high-quality products in various-sized packages in order to ensure affordable and secure fish, crab, and meat through a simplified supply chain.
            ",
            'bn'   => "",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('pages_data')->insert([
            'name' => 'r_policy',
            'en'   => "<h3>Replacement & Refunds</h3><p class='lead text-justify' style='line-height: 2.5rem;' >We have a simple and easy replacement policy; our customers can always make a claim for valid reasons. We make sure we deliver high-quality products to you, but we still expect rare scenarios of dissatisfaction regarding the defects, damages, freshness, quality, quantity, pricing, and packing issues of received items. Customers can report the case within 12 hours to our customer support team through Facebook messages or phone calls. Since we place customers first, we assure a full refund or replacement if the customer is not satisfied with the products. In the case of a refund, the amount will be credited to the same account or payment made.</p>",
            'bn'   => "",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
