@extends('pages.fbads.category.home_improvements.layouts.app')

@section('content')
    <div style="scroll-behavior: smooth;max-width: 480px;" class="tmx-auto" id="body">
        <div class="tflex tfont-medium titems-center tjustify-center trelative tshadow-md ttext-center" style="height: 50px;     background: linear-gradient(-180deg, #f53d2d, #f63); transition: transform .2s cubic-bezier(.4,0,.2,1);">
            <div >
                <div class="">
                    <p class="t-mt-2 tfont-medium  ttext-3xl ttext-white">75% Tipid sa Kuryente</p>  
                </div>
            </div>
            <button class="focus:tbg-pink-300 order_now tabsolute tbottom-0 tfixed tfont-medium tpy-2 trounded-full tshadow-lg ttext-white tw-10/12 waves-effect zoom-in-out-box theme-bg" style="bottom: -52%;max-width: 240px;width: 36%;right: 4%;color: #ffffff;">ORDER NOW!
            </button>
        </div>

        <img src="{{ asset('/images/fbads/lightbulb/banner.png') }}" class="tw-full tmb-5" alt="top_banner">


        <div class="tmx-3 tflex titems-center tmy-5">
            <div class="tw-1/2 tborder-gray-200 tborder-r-2 ttext-center ">
                <span class="ttext-sm ttext-white">
                    <i class="fas fa-star" style="color: #ee4d2d;" aria-hidden="true"></i>
                    <i class="fas fa-star" style="color: #ee4d2d;" aria-hidden="true"></i>
                    <i class="fas fa-star" style="color: #ee4d2d;" aria-hidden="true"></i>
                    <i class="fas fa-star" style="color: #ee4d2d;" aria-hidden="true"></i>
                    <i class="fas fa-star" style="color: #ee4d2d;" aria-hidden="true"></i>
                </span>
                <span class="ttext-md ttext-green-900">
                    <span class="tfont-bold"> &nbsp; 4.8</span>
                    <span class="tfont-medium">Ratings</span>
                </span>
            </div>
            <div class="tw-1/2 ttext-green-900 ttext-center tfont-medium ">19,586 + Trusted Reviews</div>
        </div>

        <div class="tborder-dashed tflex titems-center tjustify-center tmx-3 tmy-4 tpx-3 tpy-3" style="border: 2px solid #4aa30b; border-style: dashed;">
            <span class="tfont-medium">Order Today for guaranteed </span>
            <span class="theme-color tfont-medium tml-2"> FREE 4 Gifts</span>
        </div><!-- FREE 4 Gifts -->

        <div class="tflex tw-full tflex-wrap tjustify-center tpy-3 tpx-3 tmb-3">
            <div class="tw-1/2"><i class="fa-solid fa-circle-check" style="color: #fa5230;"></i> Ultra Energy Saver</div>
            <div class="tw-1/2"><i class="fa-solid fa-circle-check" style="color: #fa5230;"></i> Human Detection</div>
            <div class="tw-1/2"><i class="fa-solid fa-circle-check" style="color: #fa5230;"></i> 360° Sensing Angle</div>
            <div class="tw-1/2"><i class="fa-solid fa-circle-check" style="color: #fa5230;"></i> 1-8 meters Range</div>
            <div class="tw-1/2"><i class="fa-solid fa-circle-check" style="color: #fa5230;"></i> Easy to Install</div>
            <div class="tw-1/2"><i class="fa-solid fa-circle-check" style="color: #fa5230;"></i> Plug & Play</div>
            <div class="tw-1/2"><i class="fa-solid fa-circle-check" style="color: #fa5230;"></i> No Switch Required</div>
            <div class="tw-1/2"><i class="fa-solid fa-circle-check" style="color: #fa5230;"></i> No Wifi Needed</div>

            <div class="tw-full tmt-3"><i class="fa-solid fa-circle-check" style="color: #fa5230;"></i> No need to remove Original Lamp Socket</div>
            <div class="tw-full"><i class="fa-solid fa-circle-check" style="color: #fa5230;"></i> Adjustable Ambient Light</div>
            <div class="tw-full"><i class="fa-solid fa-circle-check" style="color: #fa5230;"></i> Adjustalbe Lighting Time</div>
            <div class="tw-full"><i class="fa-solid fa-circle-check" style="color: #fa5230;"></i> No need Tool</div>
        </div>

        <img class="tmb-3 tmt-5" src="{{ asset('/images/fbads/lightbulb/gif.gif') }}" alt="GIF">

        <img class="tmb-3 tmt-5" src="{{ asset('/images/fbads/lightbulb/1.png') }}" alt="1">

        <video class="tw-full video-testimonial" controls playsinline webkit-playsinline>
            <source src="{{ asset('/images/fbads/lightbulb/main-video.mp4') }}" type="video/mp4">
            <source src="movie.ogg" type="video/ogg">
        </video>

        <img class="tmt-5" src="{{ asset('/images/fbads/lightbulb/2.png') }}" alt="2">
        <img class="tmt-5" src="{{ asset('/images/fbads/lightbulb/5.png') }}" alt="2">


        <img class="tmt-5" src="{{ asset('/images/fbads/lightbulb/3.png') }}" alt="2">


        <img class="tmt-5" src="{{ asset('/images/fbads/lightbulb/4.png') }}" alt="2">


        <div class="tmb-5 tborder-t" >
            <div class="tborder tpx-4 tpy-5">
                <h1 class="tmb-3 ttext-2xl">Product Ratings</h1>
                <div class="tflex titems-center tjustify-between tmb-3">
                    <p>
                        <span class="ttext-2xl tfont-semibold theme-color">5.0</span>
                        <span class="ttext-xl tfont-medium theme-color"> out of 5</span>
                    </p>
                    <div class="">
                        <i class="fa-solid fa-star theme-color"></i>
                        <i class="fa-solid fa-star theme-color"></i>
                        <i class="fa-solid fa-star theme-color"></i>
                        <i class="fa-solid fa-star theme-color"></i>
                        <i class="fa-solid fa-star theme-color"></i>
                    </div>
                </div>    
                <div class="tflex titems-center tjustify-between">

                    <div class="trounded ttext-sm tmr-1 ttext-center trelative theme-bg" style="padding: 5px 5px; border: #f7442e 1px solid; color: white;">
                        <p>5 <i class="fa-solid fa-star" style="color: white;"></i> (9.5k)</p>
                    </div>
                    <div class="trounded ttext-sm tmr-1 ttext-center theme-color" style="padding: 5px 5px; border: #f7442e 1px solid;">
                        4<i class="fa-solid fa-star theme-color"></i> (0)
                    </div>
                    <div class="trounded ttext-sm tmr-1 ttext-center theme-color" style="padding: 5px 5px; border: #f7442e 1px solid;">
                        3<i class="fa-solid fa-star theme-color"></i> (0)
                    </div>
                    <div class="trounded ttext-sm tmr-1 ttext-center theme-color" style="padding: 5px 5px; border: #f7442e 1px solid;">
                        2<i class="fa-solid fa-star theme-color"></i> (0)
                    </div>
                    <div class="trounded ttext-sm tmr-1 ttext-center theme-color" style="padding: 5px 5px; border: #f7442e 1px solid;">
                        1<i class="fa-solid fa-star theme-color"></i> (0)
                    </div>
                </div>
                
                <div class="tmt-5 tpb-5">
                    <div class="tflex titems-center">
                        <img src="{{ asset('/images/fbads/lightbulb/reviews/review1/profile.png') }}" class="trounded-full" style="width: 40px;" alt="">
                        <div class="tml-2">
                            <p>Emerlita Manao</p>
                            <div class="">
                                <i class="fa-solid fa-star theme-color"></i>
                                <i class="fa-solid fa-star theme-color"></i>
                                <i class="fa-solid fa-star theme-color"></i>
                                <i class="fa-solid fa-star theme-color"></i>
                                <i class="fa-solid fa-star theme-color"></i>
                            </div>
                            <span style="margin-top: 0.25rem;margin-bottom: 0.9375rem;font-size: .75rem;color: rgba(0,0,0,.54);">April 14, 2023 09:07AM</span>
                        </div>
                    </div>
                    <div class="tpy-2" >
                        Hala!. <b>FROM 3,500 ngayon 2k</b> nalang ang <b>Meralco</b> namin.
                        Ang dami kasi naming Ilaw sa labas. Tapos di naman sustainable ung solar
                        Kaya Bumili ako nito. <b> i Purchase 8pcs na.</b>
                    </div>
                    <div class="tflex" style="">
                        <div class="tmr-2">
                            <img src="{{ asset('/images/fbads/lightbulb/reviews/review1/1.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('/images/fbads/lightbulb/reviews/review1/2.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('/images/fbads/lightbulb/reviews/review1/3.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('/images/fbads/lightbulb/reviews/review1/4.png') }}" class="tmr-1 trounded">
                        </div>
                    </div>
                </div><!-- REVIEW 1 -->

                <div class="tmt-5 tpb-5">
                    <div class="tflex titems-center">
                        <img src="{{ asset('/images/fbads/lightbulb/reviews/review6/profile.png') }}" class="trounded-full" style="width: 40px;" alt="">
                        <div class="tml-2">
                            <p>Mark Culantes</p>
                            <div class="">
                                <i class="fa-solid fa-star theme-color"></i>
                                <i class="fa-solid fa-star theme-color"></i>
                                <i class="fa-solid fa-star theme-color"></i>
                                <i class="fa-solid fa-star theme-color"></i>
                                <i class="fa-solid fa-star theme-color"></i>
                            </div>
                            <span style="margin-top: 0.25rem;margin-bottom: 0.9375rem;font-size: .75rem;color: rgba(0,0,0,.54);">July 01, 2023 08:03PM</span>
                        </div>
                    </div>
                    <div class="tpy-2" >
                        <b>Nabilihan ko </b> na ng washing ung <b> asawa ko.</b>
                        Dahil naka tipid na kami sa koryente.
                        <b>Dati 3k meralco namin wala pa washing machine.</b> 
                        Ngayon may washing na <b>bumaba pa ng 2600 </b>
                        Madilim kasi samin kaya 24hrs bukas ilaw.
                    </div>
                    <div class="tflex" style="">
                        <div class="tmr-2">
                            <img src="{{ asset('/images/fbads/lightbulb/reviews/review6/1.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('/images/fbads/lightbulb/reviews/review6/2.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('/images/fbads/lightbulb/reviews/review6/3.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('/images/fbads/lightbulb/reviews/review6/4.png') }}" class="tmr-1 trounded">
                        </div>
                    </div>
                </div><!-- REVIEW 6 -->

                <div class="tmt-5 tpb-5">
                    <div class="tflex titems-center">
                        <img src="{{ asset('/images/fbads/lightbulb/reviews/review3/profile.png') }}" class="trounded-full" style="width: 40px;" alt="">
                        <div class="tml-2">
                            <p>Rolando Baldasin</p>
                            <div class="">
                                <i class="fa-solid fa-star theme-color"></i>
                                <i class="fa-solid fa-star theme-color"></i>
                                <i class="fa-solid fa-star theme-color"></i>
                                <i class="fa-solid fa-star theme-color"></i>
                                <i class="fa-solid fa-star theme-color"></i>
                            </div>
                            <span style="margin-top: 0.25rem;margin-bottom: 0.9375rem;font-size: .75rem;color: rgba(0,0,0,.54);">July 01, 2023 08:03PM</span>
                        </div>
                    </div>
                    <div class="tpy-2" >
                        <b>Sulit ang bayad.</b>Maganda sya sa hagdan at CR. 
                        Pwde din sa labas. mas <b>bumaba pa koryente namin.</b> 
                    </div>
                    <div class="tflex" style="">
                        <div class="tmr-2">
                            <img src="{{ asset('/images/fbads/lightbulb/reviews/review3/1.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('/images/fbads/lightbulb/reviews/review3/2.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('/images/fbads/lightbulb/reviews/review3/3.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('/images/fbads/lightbulb/reviews/review3/4.png') }}" class="tmr-1 trounded">
                        </div>
                    </div>
                </div><!-- REVIEW 3 -->
                
                <div class="tmt-5 tpb-5">
                    <div class="tflex titems-center">
                        <img src="{{ asset('/images/fbads/lightbulb/reviews/review4/profile.png') }}" class="trounded-full" style="width: 40px;" alt="">
                        <div class="tml-2">
                            <p>Melinda Bergadin</p>
                            <div class="">
                                <i class="fa-solid fa-star theme-color"></i>
                                <i class="fa-solid fa-star theme-color"></i>
                                <i class="fa-solid fa-star theme-color"></i>
                                <i class="fa-solid fa-star theme-color"></i>
                                <i class="fa-solid fa-star theme-color"></i>
                            </div>
                            <span style="margin-top: 0.25rem;margin-bottom: 0.9375rem;font-size: .75rem;color: rgba(0,0,0,.54);">July 01, 2023 08:03PM</span>
                        </div>
                    </div>
                    <div class="tpy-2" >
                        <b>Sulit ang bayad.</b>Maganda sya sa hagdan at CR. 
                        Pwde din sa labas. mas <b>bumaba pa koryente namin.</b> 
                    </div>
                    <div class="tflex" style="">
                        <div class="tmr-2">
                            <img src="{{ asset('/images/fbads/lightbulb/reviews/review4/1.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('/images/fbads/lightbulb/reviews/review4/2.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('/images/fbads/lightbulb/reviews/review4/3.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('/images/fbads/lightbulb/reviews/review4/4.png') }}" class="tmr-1 trounded">
                        </div>
                    </div>
                </div><!-- REVIEW 4 -->

                <div class="tmt-5 tpb-5">
                    <div class="tflex titems-center">
                        <img src="{{ asset('/images/fbads/lightbulb/reviews/review5/profile.png') }}" class="trounded-full" style="width: 40px;" alt="">
                        <div class="tml-2">
                            <p>Sarah Peransa</p>
                            <div class="">
                                <i class="fa-solid fa-star theme-color"></i>
                                <i class="fa-solid fa-star theme-color"></i>
                                <i class="fa-solid fa-star theme-color"></i>
                                <i class="fa-solid fa-star theme-color"></i>
                                <i class="fa-solid fa-star theme-color"></i>
                            </div>
                            <span style="margin-top: 0.25rem;margin-bottom: 0.9375rem;font-size: .75rem;color: rgba(0,0,0,.54);">July 01, 2023 08:03PM</span>
                        </div>
                    </div>
                    <div class="tpy-2" >
                        Great Product. <b>Nabawasan ng ₱1,300 ung Bill namin Monthly.</b> 
                        Big Help din. <b>Malala-an pa sa Internet ung na tipid.</b> 
                        na recommend ko na din to sa mga kumare ko.
                    </div>
                    <div class="tflex" style="">
                        <div class="tmr-2">
                            <img src="{{ asset('/images/fbads/lightbulb/reviews/review5/1.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('/images/fbads/lightbulb/reviews/review5/2.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('/images/fbads/lightbulb/reviews/review5/3.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('/images/fbads/lightbulb/reviews/review5/4.png') }}" class="tmr-1 trounded">
                        </div>
                    </div>
                </div><!-- REVIEW 5 -->

                <div class="tmt-5 tpb-5">
                    <div class="tflex titems-center">
                        <img src="{{ asset('/images/fbads/lightbulb/reviews/review2/profile.png') }}" class="trounded-full" style="width: 40px;" alt="">
                        <div class="tml-2">
                            <p>Aiza Mercado</p>
                            <div class="">
                                <i class="fa-solid fa-star theme-color"></i>
                                <i class="fa-solid fa-star theme-color"></i>
                                <i class="fa-solid fa-star theme-color"></i>
                                <i class="fa-solid fa-star theme-color"></i>
                                <i class="fa-solid fa-star theme-color"></i>
                            </div>
                            <span style="margin-top: 0.25rem;margin-bottom: 0.9375rem;font-size: .75rem;color: rgba(0,0,0,.54);">June 14, 2023 12:48PM</span>
                        </div>
                    </div>
                    <div class="tpy-2" >
                        <b>TIPID talaga sa koryente.</b> Solar gamit ko dati. Kaso Ang bilis ma Lowbat lalo kapag matagal na.
                        Unlike dito bubukas lang kapag may tao. tapos di humihina ung ilaw. 
                        <b>automatic din na mamatay kapag umaga at bukas kapag</b>
                    </div>
                    <div class="tflex" style="">
                        <div class="tmr-2">
                            <img src="{{ asset('/images/fbads/lightbulb/reviews/review2/1.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('/images/fbads/lightbulb/reviews/review2/2.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('/images/fbads/lightbulb/reviews/review2/3.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('/images/fbads/lightbulb/reviews/review2/4.png') }}" class="tmr-1 trounded">
                        </div>
                    </div>
                </div><!-- REVIEW 2 -->

                <hr class="tmy-5">

                <div class=" tmb-3">
                    <span class="ttext-lg tfont-semibold theme-color tmy-3">More Reviews</span>

                    <div class="tflex tflex-wrap tmt-5">
                        <div class="tborder tp-2 tw-1/2 tmb-2">
                            <img src="https://images.loox.io/uploads/2024/8/3/QD6Cq-Rzb0g.jpg" class="tmr-1 trounded">
                            <div class="">
                                <span class="tfont-medium">Angela M.</span>
                            </div>
                            <div class="">
                                <span>
                                    <i class="fa-solid fa-circle-check ttext-green-500"></i> 
                                    Verified
                                </span>
                            </div>
                            <div class="tmb-2">
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                            </div>
                            <p>
                                I love how it automatically lights up when I enter the room. So convenient!
                            </p>
                        </div><!--more review 1 -->

                        <div class="tborder tp-2 tw-1/2 tmb-2">
                            <img src="https://images.loox.io/uploads/2024/8/3/Voa4-8-epBw.jpg" class="tmr-1 trounded">
                            <div class="">
                                <span class="tfont-medium">Sarah T.</span>
                            </div>
                            <div class="">
                                <span>
                                    <i class="fa-solid fa-circle-check ttext-green-500"></i> 
                                    Verified
                                </span>
                            </div>
                            <div class="tmb-2">
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                            </div>
                            <p>
                                Ang galing ng motion sensor nito, it makes my hallway lighting smart and efficient!
                            </p>
                        </div><!--more review 2 -->

                        <div class="tborder tp-2 tw-1/2 tmb-2">
                            <img src="https://images.loox.io/uploads/2024/8/3/6XIZDrghJpJ_mid.jpg" class="tmr-1 trounded">
                            <div class="">
                                <span class="tfont-medium">Daniel R.</span>
                            </div>
                            <div class="">
                                <span>
                                    <i class="fa-solid fa-circle-check ttext-green-500"></i> 
                                    Verified
                                </span>
                            </div>
                            <div class="tmb-2">
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                            </div>
                            <p>
                                This light bulb holder is super easy to install and works flawlessly. No more stumbling in the dark!
                            </p>
                        </div><!--more review 3 -->
                        
                        <div class="tborder tp-2 tw-1/2 tmb-2">
                            <img src="https://images.loox.io/uploads/2024/8/3/ndjnpjjuKzw_mid.jpg" class="tmr-1 trounded">
                            <div class="">
                                <span class="tfont-medium">James P.</span>
                            </div>
                            <div class="">
                                <span>
                                    <i class="fa-solid fa-circle-check ttext-green-500"></i> 
                                    Verified
                                </span>
                            </div>
                            <div class="tmb-2">
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                            </div>
                            <p>
                                This holder turns any bulb into a sensor light. It's perfect for our basement.
                            </p>
                        </div><!--more review 5 -->

                        <div class="tborder tp-2 tw-1/2 tmb-2">
                            <img src="https://scontent.fmnl30-2.fna.fbcdn.net/v/t1.6435-9/188331180_10218522411960220_6151144468265578546_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=689c2a&_nc_eui2=AeFjKnmUhLwz_CcP3-6QiWNgtnx9NeCvYKq2fH014K9gqgGW_IZFZxKmdEK1FM0tFqHg6KSH2w6rAEputS0jJOiN&_nc_ohc=sYxnk0PnJMcQ7kNvgErGibS&_nc_ht=scontent.fmnl30-2.fna&oh=00_AYCjSbs3jj_kTWQBJej3nvLrh0znnuBkiz2mN6Yv_hVmpw&oe=67064751" class="tmr-1 trounded">
                            <div class="">
                                <span class="tfont-medium">Mark B.</span>
                            </div>
                            <div class="">
                                <span>
                                    <i class="fa-solid fa-circle-check ttext-green-500"></i> 
                                    Verified
                                </span>
                            </div>
                            <div class="tmb-2">
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                            </div>
                            <p>
                                Ang ganda kasi kusa talga sya namamatay bukas legit
                                Ung natipid ko sa Ilaw. Nakakapag Aircon pa ko. kawawa kasi baby ko ang init sa tanghali.
                                
                            </p>
                        </div><!--more review 5 -->

                        <div class="tborder tp-2 tw-1/2 tmb-2">
                            <img src="https://scontent.fmnl30-1.fna.fbcdn.net/v/t39.30808-6/457038755_1600913997504512_8665573359713391975_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=833d8c&_nc_eui2=AeGBh21quEY9gtomGgbxYLgQ5pGOo5eSN6fmkY6jl5I3p6IGgcAsXxfVMZSS6bCfyhn2EevOuDKZzDzYKzNF2kOq&_nc_ohc=DCP3_cknZU0Q7kNvgGP4oJb&_nc_ht=scontent.fmnl30-1.fna&oh=00_AYDCR9Zq7UgC046T9qujY8qzJXyuTWINec-hbi_dusmyvg&oe=66E48BA6" class="tmr-1 trounded">
                            <div class="">
                                <span class="tfont-medium">Mark B.</span>
                            </div>
                            <div class="">
                                <span>
                                    <i class="fa-solid fa-circle-check ttext-green-500"></i> 
                                    Verified
                                </span>
                            </div>
                            <div class="tmb-2">
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                            </div>
                            <p>
                                Lakas maka tipid sa Koryente. Bagay talaga to sa mga makalimutin mag patay ng ilaw
                            </p>
                        </div><!--more review 4 -->

                        <div class="tborder tp-2 tw-1/2 tmb-2">
                            <img src="https://images.loox.io/uploads/2024/8/3/2MlZjhEK5f_mid.jpg" class="tmr-1 trounded">
                            <div class="">
                                <span class="tfont-medium">Rachel S.</span>
                            </div>
                            <div class="">
                                <span>
                                    <i class="fa-solid fa-circle-check ttext-green-500"></i> 
                                    Verified
                                </span>
                            </div>
                            <div class="tmb-2">
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                            </div>
                            <p>
                                Easy to install and works like a charm. Highly recommend!
                            </p>
                        </div><!--more review 5 -->

                        <div class="tborder tp-2 tw-1/2 tmb-2">
                            <img src="https://images.loox.io/uploads/2024/8/3/uE_jWfRXwS_mid.jpg" class="tmr-1 trounded">
                            <div class="">
                                <span class="tfont-medium">Lily N.</span>
                            </div>
                            <div class="">
                                <span>
                                    <i class="fa-solid fa-circle-check ttext-green-500"></i> 
                                    Verified
                                </span>
                            </div>
                            <div class="tmb-2">
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                            </div>
                            <p>
                                It detects motion accurately and the installation was very straightforward.
                            </p>
                        </div><!--more review 5 -->

                        <div class="tborder tp-2 tw-1/2 tmb-2">
                            <img src="https://images.loox.io/uploads/2024/8/3/UTwrRVFfs_mid.jpg" class="tmr-1 trounded">
                            <div class="">
                                <span class="tfont-medium">Emily V.</span>
                            </div>
                            <div class="">
                                <span>
                                    <i class="fa-solid fa-circle-check ttext-green-500"></i> 
                                    Verified
                                </span>
                            </div>
                            <div class="tmb-2">
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                            </div>
                            <p>
                               ito gamit ko sa labas ng bahay. Ang ganda automatic on/OFF tipid talaga sa koryente
                            </p>
                        </div><!--more review 5 -->

                        <div class="tborder tp-2 tw-1/2 tmb-2">
                            <img src="https://scontent.fmnl30-2.fna.fbcdn.net/v/t39.30808-6/453215189_7934172459951651_709636608049295640_n.jpg?stp=dst-jpg_p526x296&_nc_cat=109&ccb=1-7&_nc_sid=833d8c&_nc_eui2=AeH10KoaaZK3U5cLzQr_Y4Sj9REGJl3iKKn1EQYmXeIoqViEBnG6ej70Onx6hC-2PLIPwSaLdOqquj8nf3BgZYi2&_nc_ohc=orpQjtq7XOAQ7kNvgHNL4N5&_nc_ht=scontent.fmnl30-2.fna&oh=00_AYBjWwpfV5iN40rh_bBSnWND7_n2gufbr4ii50CnGTjbHg&oe=66E48C2E" class="tmr-1 trounded">
                            <div class="">
                                <span class="tfont-medium">Maricar C.</span>
                            </div>
                            <div class="">
                                <span>
                                    <i class="fa-solid fa-circle-check ttext-green-500"></i> 
                                    Verified
                                </span>
                            </div>
                            <div class="tmb-2">
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                                <i class="fa-solid fa-star theme-color" aria-hidden="true"></i>
                            </div>
                            <p>
                                Wow Grabe tipid meralco namin. BIll to sa paupahan ko
                                wala pa kasi naka tira kaya palagi bukas ilaw
                            </p>
                        </div><!--more review 5 -->

                    </div>
                </div><!-- More Reviews -->


            </div>  <!-- RATINGS DIV -->
        </div> <!-- RATINGS -->

        <img class="tmt-5 tmb-6" src="{{ asset('/images/fbads/lightbulb/6.png') }}" alt="2">
    
        <div class="tmx-auto trelative tborder tpx-5 tpb-5">
            <div class="tflex tjustify-center tflex-wrap tfont-medium titems-center ttext-center">
                
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="330" zoomAndPan="magnify" viewBox="0 0 247.5 56.249996" height="75" preserveAspectRatio="xMidYMid meet" version="1.0"><defs><clipPath id="5729b7becf"><path d="M 25 7.699219 L 97.601562 7.699219 L 97.601562 47.667969 L 25 47.667969 Z M 25 7.699219 " clip-rule="nonzero"/></clipPath><clipPath id="4df279a17d"><path d="M 11 7.699219 L 72 7.699219 L 72 11 L 11 11 Z M 11 7.699219 " clip-rule="nonzero"/></clipPath><clipPath id="2f4b2223b9"><path d="M 112.402344 16.652344 L 134.605469 16.652344 L 134.605469 38.855469 L 112.402344 38.855469 Z M 112.402344 16.652344 " clip-rule="nonzero"/></clipPath><clipPath id="ea9e484c10"><path d="M 155.8125 12 L 207 12 L 207 34 L 155.8125 34 Z M 155.8125 12 " clip-rule="nonzero"/></clipPath><clipPath id="6b2b629df7"><path d="M 170 16 L 245.371094 16 L 245.371094 46.925781 L 170 46.925781 Z M 170 16 " clip-rule="nonzero"/></clipPath><clipPath id="b182970c57"><path d="M 189 7.699219 L 245 7.699219 L 245 37 L 189 37 Z M 189 7.699219 " clip-rule="nonzero"/></clipPath><clipPath id="0031c228e8"><path d="M 97.519531 42.257812 L 114.542969 42.257812 L 114.542969 53.359375 L 97.519531 53.359375 Z M 97.519531 42.257812 " clip-rule="nonzero"/></clipPath><clipPath id="936f19ba8c"><path d="M 98 42.257812 L 108 42.257812 L 108 53 L 98 53 Z M 98 42.257812 " clip-rule="nonzero"/></clipPath><clipPath id="2c1567ec88"><path d="M 98 42.257812 L 103 42.257812 L 103 49 L 98 49 Z M 98 42.257812 " clip-rule="nonzero"/></clipPath><clipPath id="738e348c33"><path d="M 104 42.257812 L 114 42.257812 L 114 53 L 104 53 Z M 104 42.257812 " clip-rule="nonzero"/></clipPath><clipPath id="eab7268488"><path d="M 105 42.257812 L 109 42.257812 L 109 47 L 105 47 Z M 105 42.257812 " clip-rule="nonzero"/></clipPath><clipPath id="b632e994e0"><path d="M 142 47 L 146.328125 47 L 146.328125 53.238281 L 142 53.238281 Z M 142 47 " clip-rule="nonzero"/></clipPath><clipPath id="c5d5822d42"><path d="M 136.707031 44.355469 L 146 44.355469 L 146 53.238281 L 136.707031 53.238281 Z M 136.707031 44.355469 " clip-rule="nonzero"/></clipPath><clipPath id="2e67f60248"><path d="M 143 44.355469 L 146 44.355469 L 146 47 L 143 47 Z M 143 44.355469 " clip-rule="nonzero"/></clipPath></defs><g clip-path="url(#5729b7becf)"><path fill="#f7462e" d="M 51.222656 39.542969 L 47.8125 39.542969 C 47.542969 38.171875 46.867188 36.945312 45.914062 35.992188 C 44.660156 34.738281 42.929688 33.964844 41.015625 33.964844 C 39.101562 33.964844 37.371094 34.738281 36.117188 35.992188 C 35.164062 36.945312 34.492188 38.171875 34.214844 39.542969 L 27.023438 39.542969 C 26.277344 39.542969 25.675781 40.144531 25.675781 40.890625 C 25.675781 41.632812 26.277344 42.238281 27.023438 42.238281 L 34.214844 42.238281 C 34.492188 43.613281 35.164062 44.839844 36.117188 45.792969 C 37.371094 47.042969 39.101562 47.820312 41.015625 47.820312 C 42.929688 47.820312 44.660156 47.042969 45.914062 45.792969 C 46.867188 44.839844 47.542969 43.613281 47.8125 42.238281 L 67.128906 42.238281 C 67.398438 43.613281 68.078125 44.839844 69.027344 45.792969 C 70.28125 47.042969 72.015625 47.820312 73.925781 47.820312 C 75.839844 47.820312 77.570312 47.042969 78.824219 45.792969 C 79.777344 44.839844 80.457031 43.613281 80.726562 42.238281 L 90.648438 42.238281 C 92.484375 42.238281 94.152344 41.488281 95.363281 40.28125 C 96.566406 39.070312 97.316406 37.40625 97.316406 35.566406 L 97.316406 31.257812 C 97.316406 29.730469 96.816406 28.316406 95.941406 27.179688 C 95.066406 26.046875 93.832031 25.199219 92.347656 24.8125 L 88.351562 23.75 L 84.660156 12.007812 L 84.625 11.914062 C 84.113281 10.621094 83.257812 9.574219 82.183594 8.839844 C 81.101562 8.109375 79.8125 7.699219 78.429688 7.699219 L 68.0625 7.699219 C 67.320312 7.699219 66.714844 8.300781 66.714844 9.046875 C 66.714844 9.789062 67.320312 10.394531 68.0625 10.394531 L 78.429688 10.394531 C 79.269531 10.394531 80.046875 10.632812 80.675781 11.058594 C 81.292969 11.480469 81.789062 12.082031 82.097656 12.828125 L 86.230469 25.972656 L 91.664062 27.410156 C 92.554688 27.648438 93.296875 28.148438 93.8125 28.820312 C 94.328125 29.492188 94.621094 30.332031 94.621094 31.257812 L 94.621094 35.566406 C 94.621094 36.664062 94.175781 37.65625 93.457031 38.378906 C 92.734375 39.097656 91.742188 39.542969 90.648438 39.542969 L 80.726562 39.542969 C 80.457031 38.171875 79.777344 36.945312 78.824219 35.992188 C 77.570312 34.738281 75.839844 33.964844 73.925781 33.964844 C 72.015625 33.964844 70.28125 34.738281 69.027344 35.992188 C 68.078125 36.945312 67.398438 38.171875 67.128906 39.542969 Z M 69.691406 40.890625 C 69.691406 39.722656 70.167969 38.664062 70.933594 37.898438 C 71.699219 37.132812 72.757812 36.660156 73.925781 36.660156 C 75.097656 36.660156 76.15625 37.132812 76.921875 37.898438 C 77.6875 38.664062 78.160156 39.722656 78.160156 40.890625 C 78.160156 42.0625 77.6875 43.121094 76.921875 43.886719 C 76.15625 44.652344 75.097656 45.125 73.925781 45.125 C 72.757812 45.125 71.699219 44.652344 70.933594 43.886719 C 70.167969 43.121094 69.691406 42.0625 69.691406 40.890625 Z M 44.007812 37.898438 C 44.773438 38.664062 45.25 39.722656 45.25 40.890625 C 45.25 42.0625 44.773438 43.121094 44.007812 43.886719 C 43.242188 44.652344 42.183594 45.125 41.015625 45.125 C 39.84375 45.125 38.789062 44.652344 38.019531 43.886719 C 37.253906 43.121094 36.78125 42.0625 36.78125 40.890625 C 36.78125 39.722656 37.253906 38.664062 38.019531 37.898438 C 38.789062 37.132812 39.84375 36.660156 41.015625 36.660156 C 42.183594 36.660156 43.242188 37.132812 44.007812 37.898438 Z M 44.007812 37.898438 " fill-opacity="1" fill-rule="evenodd"/></g><path fill="#f7462e" d="M 73.953125 22.292969 C 73.953125 23.222656 74.707031 23.976562 75.636719 23.976562 L 82.691406 23.976562 L 79.347656 13.34375 L 75.636719 13.34375 C 74.707031 13.34375 73.953125 14.101562 73.953125 15.027344 Z M 73.953125 22.292969 " fill-opacity="1" fill-rule="evenodd"/><g clip-path="url(#4df279a17d)"><path fill="#f7462e" d="M 12.765625 7.699219 L 69.910156 7.699219 C 70.652344 7.699219 71.261719 8.304688 71.261719 9.046875 C 71.261719 9.789062 70.652344 10.394531 69.910156 10.394531 L 12.765625 10.394531 C 12.027344 10.394531 11.417969 9.789062 11.417969 9.046875 C 11.417969 8.304688 12.027344 7.699219 12.765625 7.699219 Z M 12.765625 7.699219 " fill-opacity="1" fill-rule="evenodd"/></g><path fill="#f7462e" d="M 44.691406 16.566406 L 41.203125 16.566406 L 40.691406 18.957031 L 43.902344 18.957031 L 43.503906 20.796875 L 40.296875 20.796875 L 39.492188 24.628906 L 37.246094 24.628906 L 39.347656 14.722656 L 45.078125 14.722656 Z M 53.28125 17.242188 C 53.28125 17.664062 53.203125 18.042969 53.054688 18.378906 C 52.902344 18.71875 52.695312 19.015625 52.433594 19.257812 C 52.167969 19.511719 51.863281 19.710938 51.511719 19.867188 C 51.160156 20.023438 50.785156 20.132812 50.382812 20.183594 L 50.382812 20.214844 C 50.667969 20.304688 50.910156 20.476562 51.109375 20.738281 C 51.316406 20.996094 51.46875 21.339844 51.566406 21.769531 L 52.261719 24.628906 L 49.867188 24.628906 L 49.328125 22.074219 C 49.246094 21.667969 49.101562 21.359375 48.894531 21.152344 C 48.6875 20.941406 48.40625 20.835938 48.046875 20.835938 L 47.667969 20.835938 L 46.859375 24.628906 L 44.609375 24.628906 L 46.714844 14.722656 L 50.101562 14.722656 C 50.671875 14.722656 51.164062 14.792969 51.566406 14.925781 C 51.976562 15.066406 52.304688 15.25 52.558594 15.480469 C 52.808594 15.710938 52.992188 15.980469 53.109375 16.285156 C 53.222656 16.585938 53.28125 16.910156 53.28125 17.242188 Z M 50.902344 17.609375 C 50.902344 17.226562 50.792969 16.929688 50.566406 16.71875 C 50.339844 16.5 50.003906 16.394531 49.546875 16.394531 L 48.617188 16.394531 L 48.019531 19.148438 L 48.925781 19.148438 C 49.265625 19.148438 49.558594 19.109375 49.8125 19.023438 C 50.054688 18.9375 50.261719 18.828125 50.421875 18.683594 C 50.585938 18.542969 50.707031 18.378906 50.785156 18.195312 C 50.863281 18.007812 50.902344 17.808594 50.902344 17.609375 Z M 61.085938 16.539062 L 57.625 16.539062 L 57.15625 18.773438 L 60.378906 18.773438 L 59.988281 20.59375 L 56.777344 20.59375 L 56.292969 22.816406 L 59.988281 22.816406 L 59.597656 24.628906 L 53.664062 24.628906 L 55.765625 14.722656 L 61.472656 14.722656 Z M 68.578125 16.539062 L 65.117188 16.539062 L 64.648438 18.773438 L 67.875 18.773438 L 67.480469 20.59375 L 64.269531 20.59375 L 63.789062 22.816406 L 67.480469 22.816406 L 67.09375 24.628906 L 61.152344 24.628906 L 63.261719 14.722656 L 68.964844 14.722656 Z M 68.578125 16.539062 " fill-opacity="1" fill-rule="nonzero"/><path fill="#f7462e" d="M 39.863281 28.34375 C 39.796875 28.304688 39.722656 28.269531 39.648438 28.230469 C 39.570312 28.191406 39.484375 28.15625 39.398438 28.128906 C 39.304688 28.097656 39.214844 28.074219 39.117188 28.054688 C 39.015625 28.035156 38.914062 28.027344 38.808594 28.027344 C 38.6875 28.027344 38.585938 28.042969 38.507812 28.074219 C 38.425781 28.109375 38.363281 28.148438 38.3125 28.195312 C 38.265625 28.242188 38.230469 28.296875 38.207031 28.351562 C 38.1875 28.40625 38.179688 28.460938 38.179688 28.507812 C 38.179688 28.574219 38.1875 28.636719 38.210938 28.695312 C 38.230469 28.753906 38.265625 28.8125 38.3125 28.863281 C 38.363281 28.917969 38.425781 28.972656 38.496094 29.027344 C 38.574219 29.082031 38.667969 29.144531 38.777344 29.210938 C 38.921875 29.296875 39.046875 29.386719 39.15625 29.476562 C 39.261719 29.5625 39.359375 29.660156 39.433594 29.761719 C 39.511719 29.863281 39.570312 29.972656 39.613281 30.09375 C 39.652344 30.210938 39.671875 30.34375 39.671875 30.492188 C 39.671875 30.578125 39.660156 30.675781 39.640625 30.777344 C 39.621094 30.878906 39.585938 30.984375 39.535156 31.085938 C 39.488281 31.191406 39.425781 31.285156 39.339844 31.382812 C 39.253906 31.480469 39.144531 31.566406 39.019531 31.636719 C 38.894531 31.710938 38.742188 31.773438 38.5625 31.816406 C 38.378906 31.859375 38.171875 31.882812 37.933594 31.882812 C 37.804688 31.882812 37.671875 31.875 37.542969 31.855469 C 37.417969 31.839844 37.296875 31.816406 37.183594 31.78125 C 37.070312 31.753906 36.964844 31.71875 36.863281 31.679688 C 36.769531 31.644531 36.679688 31.605469 36.605469 31.566406 L 36.777344 30.675781 C 36.855469 30.734375 36.941406 30.785156 37.027344 30.832031 C 37.121094 30.886719 37.214844 30.929688 37.316406 30.96875 C 37.414062 31.003906 37.519531 31.03125 37.625 31.054688 C 37.730469 31.074219 37.835938 31.085938 37.949219 31.085938 C 38.066406 31.085938 38.167969 31.074219 38.25 31.046875 C 38.335938 31.023438 38.40625 30.984375 38.457031 30.941406 C 38.507812 30.890625 38.542969 30.839844 38.570312 30.78125 C 38.59375 30.71875 38.601562 30.65625 38.601562 30.582031 C 38.601562 30.515625 38.59375 30.453125 38.570312 30.394531 C 38.550781 30.34375 38.511719 30.289062 38.460938 30.238281 C 38.410156 30.1875 38.347656 30.132812 38.261719 30.078125 C 38.179688 30.019531 38.078125 29.957031 37.960938 29.890625 C 37.832031 29.816406 37.714844 29.742188 37.609375 29.660156 C 37.507812 29.578125 37.417969 29.484375 37.339844 29.386719 C 37.269531 29.285156 37.207031 29.167969 37.167969 29.042969 C 37.125 28.921875 37.105469 28.78125 37.105469 28.628906 C 37.105469 28.457031 37.132812 28.285156 37.203125 28.117188 C 37.265625 27.949219 37.371094 27.800781 37.503906 27.671875 C 37.644531 27.535156 37.816406 27.429688 38.035156 27.351562 C 38.25 27.269531 38.507812 27.226562 38.800781 27.226562 C 38.925781 27.226562 39.046875 27.238281 39.160156 27.25 C 39.273438 27.261719 39.382812 27.28125 39.488281 27.304688 C 39.59375 27.328125 39.691406 27.351562 39.78125 27.382812 C 39.875 27.410156 39.960938 27.445312 40.03125 27.472656 Z M 44.015625 31.804688 L 42.992188 31.804688 L 43.378906 29.988281 L 41.53125 29.988281 L 41.144531 31.804688 L 40.117188 31.804688 L 41.078125 27.304688 L 42.097656 27.304688 L 41.710938 29.101562 L 43.566406 29.101562 L 43.953125 27.304688 L 44.972656 27.304688 Z M 46.050781 31.804688 L 45.03125 31.804688 L 45.976562 27.304688 L 47.003906 27.304688 Z M 51.042969 28.585938 C 51.042969 28.808594 51.003906 29.019531 50.929688 29.222656 C 50.851562 29.421875 50.730469 29.601562 50.566406 29.75 C 50.402344 29.90625 50.195312 30.023438 49.945312 30.117188 C 49.695312 30.207031 49.390625 30.257812 49.046875 30.257812 L 48.414062 30.257812 L 48.085938 31.804688 L 47.066406 31.804688 L 48.019531 27.304688 L 49.566406 27.304688 C 49.820312 27.304688 50.042969 27.339844 50.230469 27.40625 C 50.414062 27.46875 50.566406 27.558594 50.6875 27.675781 C 50.808594 27.785156 50.898438 27.921875 50.957031 28.078125 C 51.015625 28.234375 51.042969 28.402344 51.042969 28.585938 Z M 49.96875 28.652344 C 49.96875 28.480469 49.910156 28.339844 49.796875 28.238281 C 49.675781 28.136719 49.507812 28.085938 49.277344 28.085938 L 48.875 28.085938 L 48.582031 29.484375 L 49.046875 29.484375 C 49.207031 29.484375 49.34375 29.460938 49.460938 29.417969 C 49.574219 29.375 49.671875 29.3125 49.75 29.234375 C 49.824219 29.160156 49.878906 29.070312 49.917969 28.972656 C 49.949219 28.871094 49.96875 28.765625 49.96875 28.652344 Z M 55.09375 28.585938 C 55.09375 28.808594 55.054688 29.019531 54.976562 29.222656 C 54.898438 29.421875 54.773438 29.601562 54.617188 29.75 C 54.453125 29.90625 54.246094 30.023438 53.996094 30.117188 C 53.738281 30.207031 53.441406 30.257812 53.09375 30.257812 L 52.457031 30.257812 L 52.136719 31.804688 L 51.109375 31.804688 L 52.070312 27.304688 L 53.613281 27.304688 C 53.871094 27.304688 54.089844 27.339844 54.273438 27.40625 C 54.460938 27.46875 54.617188 27.558594 54.734375 27.675781 C 54.855469 27.785156 54.941406 27.921875 55 28.078125 C 55.0625 28.234375 55.09375 28.402344 55.09375 28.585938 Z M 54.019531 28.652344 C 54.019531 28.480469 53.960938 28.339844 53.839844 28.238281 C 53.726562 28.136719 53.550781 28.085938 53.324219 28.085938 L 52.925781 28.085938 L 52.628906 29.484375 L 53.09375 29.484375 C 53.253906 29.484375 53.394531 29.460938 53.507812 29.417969 C 53.625 29.375 53.71875 29.3125 53.792969 29.234375 C 53.871094 29.160156 53.925781 29.070312 53.960938 28.972656 C 54 28.871094 54.019531 28.765625 54.019531 28.652344 Z M 56.179688 31.804688 L 55.160156 31.804688 L 56.109375 27.304688 L 57.132812 27.304688 Z M 61.3125 31.804688 L 60.386719 31.804688 L 58.984375 28.945312 C 58.96875 28.921875 58.953125 28.894531 58.9375 28.859375 C 58.925781 28.828125 58.910156 28.792969 58.894531 28.757812 C 58.882812 28.71875 58.867188 28.691406 58.851562 28.65625 C 58.84375 28.625 58.832031 28.601562 58.828125 28.570312 L 58.808594 28.570312 C 58.800781 28.652344 58.785156 28.738281 58.769531 28.835938 C 58.761719 28.925781 58.742188 29.023438 58.71875 29.121094 L 58.144531 31.804688 L 57.195312 31.804688 L 58.144531 27.304688 L 59.152344 27.304688 L 60.5 30.058594 C 60.507812 30.078125 60.523438 30.105469 60.539062 30.140625 C 60.550781 30.175781 60.570312 30.207031 60.585938 30.242188 C 60.601562 30.277344 60.613281 30.308594 60.628906 30.34375 C 60.644531 30.375 60.652344 30.40625 60.65625 30.429688 L 60.671875 30.429688 C 60.671875 30.402344 60.675781 30.363281 60.683594 30.324219 C 60.6875 30.285156 60.691406 30.246094 60.695312 30.207031 C 60.703125 30.167969 60.710938 30.132812 60.714844 30.09375 C 60.726562 30.054688 60.730469 30.019531 60.734375 29.992188 L 61.308594 27.304688 L 62.265625 27.304688 Z M 66.472656 28.414062 C 66.40625 28.367188 66.335938 28.324219 66.246094 28.285156 C 66.160156 28.242188 66.066406 28.210938 65.96875 28.179688 C 65.863281 28.148438 65.757812 28.125 65.640625 28.105469 C 65.53125 28.085938 65.410156 28.078125 65.289062 28.078125 C 65.03125 28.078125 64.792969 28.117188 64.582031 28.207031 C 64.371094 28.285156 64.191406 28.40625 64.046875 28.5625 C 63.898438 28.714844 63.78125 28.902344 63.707031 29.121094 C 63.628906 29.332031 63.589844 29.574219 63.589844 29.835938 C 63.589844 30.03125 63.613281 30.199219 63.667969 30.347656 C 63.71875 30.496094 63.792969 30.628906 63.894531 30.726562 C 63.988281 30.828125 64.105469 30.910156 64.246094 30.964844 C 64.382812 31.015625 64.539062 31.046875 64.707031 31.046875 C 64.816406 31.046875 64.914062 31.039062 64.988281 31.027344 C 65.0625 31.011719 65.132812 30.992188 65.1875 30.976562 L 65.382812 30.0625 L 64.464844 30.0625 L 64.640625 29.253906 L 66.566406 29.253906 L 66.078125 31.535156 C 65.992188 31.582031 65.890625 31.625 65.785156 31.660156 C 65.679688 31.699219 65.5625 31.738281 65.4375 31.773438 C 65.3125 31.804688 65.179688 31.835938 65.035156 31.855469 C 64.890625 31.875 64.730469 31.882812 64.5625 31.882812 C 64.246094 31.882812 63.957031 31.835938 63.699219 31.738281 C 63.445312 31.644531 63.234375 31.507812 63.0625 31.328125 C 62.886719 31.15625 62.753906 30.945312 62.660156 30.699219 C 62.570312 30.453125 62.519531 30.179688 62.519531 29.886719 C 62.519531 29.648438 62.550781 29.421875 62.597656 29.195312 C 62.652344 28.976562 62.734375 28.769531 62.835938 28.570312 C 62.941406 28.375 63.066406 28.191406 63.222656 28.027344 C 63.378906 27.863281 63.5625 27.722656 63.769531 27.601562 C 63.980469 27.488281 64.210938 27.394531 64.472656 27.328125 C 64.734375 27.261719 65.023438 27.226562 65.339844 27.226562 C 65.476562 27.226562 65.613281 27.238281 65.742188 27.25 C 65.871094 27.269531 65.992188 27.289062 66.109375 27.316406 C 66.21875 27.339844 66.324219 27.367188 66.417969 27.394531 C 66.511719 27.429688 66.597656 27.457031 66.671875 27.488281 Z M 66.472656 28.414062 " fill-opacity="1" fill-rule="nonzero"/><path fill="#f7462e" d="M 4.429688 15.917969 L 26.128906 15.917969 C 26.867188 15.917969 27.476562 16.523438 27.476562 17.265625 C 27.476562 18.007812 26.867188 18.613281 26.128906 18.613281 L 4.429688 18.613281 C 3.6875 18.613281 3.078125 18.007812 3.078125 17.265625 C 3.078125 16.523438 3.6875 15.917969 4.429688 15.917969 Z M 4.429688 15.917969 " fill-opacity="1" fill-rule="evenodd"/><path fill="#f7462e" d="M 10.269531 23.5625 L 28.558594 23.5625 C 29.300781 23.5625 29.90625 24.171875 29.90625 24.910156 C 29.90625 25.652344 29.300781 26.261719 28.558594 26.261719 L 10.269531 26.261719 C 9.527344 26.261719 8.921875 25.652344 8.921875 24.910156 C 8.921875 24.171875 9.527344 23.5625 10.269531 23.5625 Z M 10.269531 23.5625 " fill-opacity="1" fill-rule="evenodd"/><path fill="#f7462e" d="M 18.1875 31.210938 L 30.992188 31.210938 C 31.730469 31.210938 32.339844 31.816406 32.339844 32.558594 C 32.339844 33.300781 31.730469 33.90625 30.992188 33.90625 L 18.1875 33.90625 C 17.445312 33.90625 16.839844 33.300781 16.839844 32.558594 C 16.839844 31.816406 17.445312 31.210938 18.1875 31.210938 Z M 18.1875 31.210938 " fill-opacity="1" fill-rule="evenodd"/><g clip-path="url(#2f4b2223b9)"><path fill="#000000" d="M 126.949219 24.691406 C 126.738281 24.691406 126.566406 24.519531 126.566406 24.308594 C 126.566406 24.308594 126.566406 17.8125 126.566406 17.8125 C 126.566406 17.175781 126.050781 16.664062 125.417969 16.664062 L 121.589844 16.664062 C 120.953125 16.664062 120.441406 17.175781 120.441406 17.8125 L 120.441406 24.308594 C 120.441406 24.519531 120.269531 24.691406 120.058594 24.691406 C 120.058594 24.691406 113.558594 24.691406 113.558594 24.691406 C 112.925781 24.691406 112.410156 25.207031 112.410156 25.839844 L 112.410156 29.667969 C 112.410156 30.304688 112.925781 30.816406 113.558594 30.816406 L 120.058594 30.816406 C 120.269531 30.816406 120.441406 30.988281 120.441406 31.199219 C 120.441406 31.199219 120.441406 37.699219 120.441406 37.699219 C 120.441406 38.332031 120.953125 38.847656 121.589844 38.847656 L 125.417969 38.847656 C 126.050781 38.847656 126.566406 38.332031 126.566406 37.699219 L 126.566406 31.199219 C 126.566406 30.988281 126.738281 30.816406 126.949219 30.816406 C 126.949219 30.816406 133.449219 30.816406 133.449219 30.816406 C 134.082031 30.816406 134.597656 30.304688 134.597656 29.667969 L 134.597656 25.839844 C 134.597656 25.207031 134.082031 24.691406 133.449219 24.691406 Z M 126.949219 24.691406 " fill-opacity="1" fill-rule="evenodd"/></g><path fill="#fefefe" d="M 214.578125 24.574219 L 232.953125 24.574219 C 233.230469 24.574219 233.5 24.628906 233.753906 24.734375 C 234.011719 24.839844 234.238281 24.992188 234.433594 25.1875 C 234.628906 25.382812 234.78125 25.609375 234.886719 25.867188 C 234.996094 26.121094 235.046875 26.390625 235.046875 26.667969 L 235.046875 29.21875 C 235.046875 29.496094 234.996094 29.761719 234.886719 30.019531 C 234.78125 30.273438 234.628906 30.5 234.433594 30.699219 C 234.238281 30.894531 234.011719 31.046875 233.753906 31.152344 C 233.5 31.257812 233.230469 31.3125 232.953125 31.3125 L 214.578125 31.3125 C 214.300781 31.3125 214.035156 31.257812 213.777344 31.152344 C 213.519531 31.046875 213.292969 30.894531 213.097656 30.699219 C 212.902344 30.5 212.75 30.273438 212.644531 30.019531 C 212.539062 29.761719 212.484375 29.496094 212.484375 29.21875 L 212.484375 26.667969 C 212.484375 26.390625 212.539062 26.121094 212.644531 25.867188 C 212.75 25.609375 212.902344 25.382812 213.097656 25.1875 C 213.292969 24.992188 213.519531 24.839844 213.777344 24.734375 C 214.035156 24.628906 214.300781 24.574219 214.578125 24.574219 Z M 214.578125 24.574219 " fill-opacity="1" fill-rule="evenodd"/><path fill="#fefefe" d="M 200.589844 15.972656 L 212.972656 15.972656 C 213.25 15.972656 213.515625 16.023438 213.773438 16.128906 C 214.027344 16.238281 214.253906 16.386719 214.453125 16.585938 C 214.648438 16.78125 214.800781 17.007812 214.90625 17.261719 C 215.011719 17.519531 215.066406 17.785156 215.066406 18.066406 L 215.066406 28.429688 C 215.066406 28.707031 215.011719 28.972656 214.90625 29.230469 C 214.800781 29.484375 214.648438 29.710938 214.453125 29.910156 C 214.253906 30.105469 214.027344 30.257812 213.773438 30.363281 C 213.515625 30.46875 213.25 30.523438 212.972656 30.523438 L 200.589844 30.523438 C 200.3125 30.523438 200.042969 30.46875 199.789062 30.363281 C 199.53125 30.257812 199.304688 30.105469 199.109375 29.910156 C 198.914062 29.710938 198.761719 29.484375 198.65625 29.230469 C 198.550781 28.972656 198.496094 28.707031 198.496094 28.429688 L 198.496094 18.066406 C 198.496094 17.785156 198.550781 17.519531 198.65625 17.261719 C 198.761719 17.007812 198.914062 16.78125 199.109375 16.585938 C 199.304688 16.386719 199.53125 16.238281 199.789062 16.128906 C 200.042969 16.023438 200.3125 15.972656 200.589844 15.972656 Z M 200.589844 15.972656 " fill-opacity="1" fill-rule="evenodd"/><path fill="#fefefe" d="M 156.832031 13.984375 L 205.898438 13.984375 L 201.152344 32.628906 L 156.832031 32.628906 Z M 156.832031 13.984375 " fill-opacity="1" fill-rule="evenodd"/><g clip-path="url(#ea9e484c10)"><path stroke-linecap="round" transform="matrix(0.015173, 0, 0, 0.015173, 155.814216, 7.716762)" fill="none" stroke-linejoin="round" d="M 67.080786 413.077541 L 3300.884316 413.077541 L 2988.085073 1641.876542 L 67.080786 1641.876542 Z M 67.080786 413.077541 " stroke="#fefefe" stroke-width="134.033005" stroke-opacity="1" stroke-miterlimit="4"/></g><path fill="#fefefe" d="M 187.445312 30.515625 L 242.675781 30.515625 C 242.894531 30.515625 243.09375 30.5625 243.273438 30.664062 C 243.453125 30.765625 243.597656 30.90625 243.710938 31.09375 C 243.824219 31.277344 243.894531 31.492188 243.921875 31.734375 C 243.949219 31.976562 243.933594 32.230469 243.875 32.492188 L 241.257812 43.882812 C 241.199219 44.144531 241.097656 44.398438 240.960938 44.640625 C 240.820312 44.882812 240.652344 45.097656 240.453125 45.28125 C 240.257812 45.464844 240.042969 45.609375 239.820312 45.710938 C 239.59375 45.808594 239.371094 45.859375 239.152344 45.859375 L 183.921875 45.859375 C 183.703125 45.859375 183.503906 45.808594 183.324219 45.710938 C 183.144531 45.609375 183 45.464844 182.886719 45.28125 C 182.773438 45.097656 182.703125 44.882812 182.675781 44.640625 C 182.644531 44.398438 182.660156 44.144531 182.722656 43.882812 L 185.335938 32.492188 C 185.398438 32.230469 185.496094 31.976562 185.636719 31.734375 C 185.777344 31.492188 185.945312 31.277344 186.144531 31.09375 C 186.339844 30.90625 186.550781 30.765625 186.777344 30.664062 C 187.003906 30.5625 187.226562 30.515625 187.445312 30.515625 Z M 187.445312 30.515625 " fill-opacity="1" fill-rule="evenodd"/><g clip-path="url(#6b2b629df7)"><path stroke-linecap="butt" transform="matrix(0.015173, 0, -0.00416468, 0.0181397, 185.79161, 30.514149)" fill="none" stroke-linejoin="miter" d="M 109.012375 0.0813706 L 3749.068749 0.0813706 C 3763.485833 0.0813706 3777.324963 2.665476 3790.704353 8.264371 C 3804.083742 13.863266 3815.737172 21.615582 3826.040302 31.952003 C 3836.284326 42.073082 3844.16928 53.916898 3849.636055 67.268109 C 3855.102831 80.61932 3857.915001 94.616557 3858.013458 109.044478 L 3857.879644 736.982069 C 3857.9781 751.40999 3855.126415 765.407227 3849.780378 778.758438 C 3844.176892 792.109649 3836.357521 803.953465 3826.00571 814.074544 C 3815.911347 824.195623 3803.938673 832.163281 3790.800926 837.762176 C 3777.346623 843.145729 3763.440483 845.945176 3749.023398 845.945176 L 108.967025 845.945176 C 94.54994 845.945176 80.651703 843.145729 67.33142 837.762176 C 53.952031 832.163281 42.239494 824.195623 31.995471 814.074544 C 21.751447 803.953465 13.866493 792.109649 8.399718 778.758438 C 2.675494 765.407227 -0.136676 751.40999 0.0223154 736.982069 L -0.101318 109.044478 C 0.0576728 94.616557 2.65191 80.61932 8.255395 67.268109 C 13.858881 53.916898 21.678252 42.073082 32.030063 31.952003 C 42.065319 21.615582 53.839652 13.863266 67.234847 8.264371 C 80.630043 2.665476 94.59529 0.0813706 109.012375 0.0813706 Z M 109.012375 0.0813706 " stroke="#fefefe" stroke-width="134.033005" stroke-opacity="1" stroke-miterlimit="4"/></g><path fill="#f7462e" d="M 157.453125 14.148438 L 205.898438 14.148438 L 201.210938 32.449219 L 157.453125 32.449219 Z M 157.453125 14.148438 " fill-opacity="1" fill-rule="evenodd"/><path fill="#fefefe" d="M 161.929688 27.777344 C 163.355469 27.777344 164.265625 26.925781 164.539062 25.5 L 164.796875 24.179688 L 163.402344 24.179688 L 163.128906 25.605469 C 163.007812 26.210938 162.671875 26.457031 162.230469 26.457031 C 161.792969 26.457031 161.550781 26.210938 161.671875 25.605469 L 162.671875 20.433594 C 162.792969 19.824219 163.128906 19.566406 163.566406 19.566406 C 164.007812 19.566406 164.25 19.824219 164.144531 20.433594 L 163.933594 21.492188 L 165.3125 21.492188 L 165.507812 20.523438 C 165.78125 19.097656 165.207031 18.246094 163.796875 18.246094 C 162.367188 18.246094 161.457031 19.097656 161.183594 20.523438 L 160.214844 25.5 C 159.941406 26.925781 160.519531 27.777344 161.929688 27.777344 Z M 164.613281 27.640625 L 165.980469 27.640625 L 166.601562 25.832031 L 168.269531 25.832031 L 168.269531 25.804688 L 168.179688 27.640625 L 169.652344 27.640625 L 169.925781 18.382812 L 167.9375 18.382812 Z M 167.011719 24.574219 L 168.542969 19.992188 L 168.574219 19.992188 L 168.332031 24.574219 Z M 172.199219 27.777344 C 173.640625 27.777344 174.582031 26.925781 174.871094 25.421875 C 175.097656 24.269531 174.855469 23.527344 173.839844 22.449219 C 173.035156 21.613281 172.824219 21.128906 172.960938 20.445312 C 173.082031 19.824219 173.398438 19.566406 173.855469 19.566406 C 174.324219 19.566406 174.554688 19.824219 174.417969 20.476562 L 174.324219 20.960938 L 175.707031 20.960938 L 175.78125 20.566406 C 176.070312 19.097656 175.539062 18.246094 174.097656 18.246094 C 172.671875 18.246094 171.746094 19.097656 171.472656 20.554688 C 171.261719 21.601562 171.519531 22.359375 172.535156 23.4375 C 173.339844 24.269531 173.535156 24.757812 173.382812 25.53125 C 173.246094 26.210938 172.914062 26.457031 172.445312 26.457031 C 171.972656 26.457031 171.730469 26.210938 171.851562 25.546875 L 171.972656 24.90625 L 170.59375 24.90625 L 170.488281 25.4375 C 170.199219 26.925781 170.757812 27.777344 172.199219 27.777344 Z M 175.28125 27.640625 L 176.738281 27.640625 L 177.558594 23.464844 L 179.136719 23.464844 L 178.316406 27.640625 L 179.789062 27.640625 L 181.59375 18.382812 L 180.121094 18.382812 L 179.394531 22.144531 L 177.816406 22.144531 L 178.542969 18.382812 L 177.085938 18.382812 Z M 185.113281 27.777344 C 186.554688 27.777344 187.511719 26.925781 187.800781 25.4375 L 188.738281 20.566406 C 189.027344 19.097656 188.40625 18.246094 186.964844 18.246094 C 185.523438 18.246094 184.582031 19.097656 184.277344 20.566406 L 183.339844 25.4375 C 183.050781 26.925781 183.671875 27.777344 185.113281 27.777344 Z M 185.371094 26.457031 C 184.902344 26.457031 184.65625 26.199219 184.792969 25.53125 L 185.765625 20.476562 C 185.902344 19.824219 186.234375 19.566406 186.707031 19.566406 C 187.175781 19.566406 187.417969 19.824219 187.296875 20.476562 L 186.3125 25.53125 C 186.175781 26.199219 185.839844 26.457031 185.371094 26.457031 Z M 188.359375 27.640625 L 189.664062 27.640625 L 190.984375 20.871094 L 191 20.871094 L 191.457031 27.640625 L 192.957031 27.640625 L 194.761719 18.382812 L 193.457031 18.382812 L 192.382812 23.921875 L 192.351562 23.921875 L 192 18.382812 L 190.152344 18.382812 Z M 188.359375 27.640625 " fill-opacity="1" fill-rule="evenodd"/><g clip-path="url(#b182970c57)"><path stroke-linecap="butt" transform="matrix(0.015173, 0, 0, 0.015173, 155.814216, 7.716762)" fill="none" stroke-linejoin="miter" d="M 4962.968193 295.93873 C 4961.938402 296.968522 4961.938402 299.028105 4960.90861 300.057897 M 4649.911503 1140.110514 L 4578.083528 1140.882858 M 5402.946717 1027.09087 C 5457.010784 1080.897488 5484.042817 1159.934005 5468.081045 1249.010991 C 5441.049012 1409.915951 5288.897281 1539.927159 5127.992321 1539.927159 C 4968.117152 1539.927159 4859.989019 1409.915951 4888.050844 1249.010991 C 4888.050844 1244.891824 4889.080636 1241.030105 4890.110427 1235.881146 C 4867.969905 1253.902502 4846.08683 1270.121722 4821.886724 1285.053702 L 3956.089314 1287.113286 C 3910.006133 1425.877723 3772.014039 1531.946273 3627.070851 1531.946273 C 3467.968026 1531.946273 3360.097341 1402.964857 3386.099583 1243.089688 L 3360.097341 1243.089688 C 3361.127133 1243.089688 3361.127133 1242.059897 3361.127133 1241.030105 C 3370.910154 1180.014944 3398.971979 1123.11895 3437.074274 1073.946394 L 3433.984899 1073.946394 C 3380.950624 1073.946394 3336.927027 1030.952589 3336.927027 976.888522 L 3336.927027 976.116178 C 3336.927027 923.081903 3380.950624 879.058306 3433.984899 879.058306 L 3421.112502 879.058306 C 3459.98714 866.958253 3488.048965 829.88575 3488.048965 786.891945 L 3488.048965 786.119601 C 3488.048965 737.976837 3453.036046 698.072407 3406.952865 691.121313 L 3039.059764 691.121313 C 2986.025489 691.121313 2943.031684 647.097715 2943.031684 594.063441 L 2943.031684 592.003857 C 2943.031684 538.969582 2986.025489 495.975777 3039.059764 495.975777 L 3431.925315 495.975777 L 3464.106307 311.900502 L 3358.037757 311.900502 C 3305.003483 311.900502 3262.009677 268.906697 3262.009677 215.872422 L 3262.009677 214.070286 C 3262.009677 161.036011 3305.003483 117.012414 3358.037757 117.012414 L 3497.059643 117.012414 L 3510.961832 34.114179 L 4103.092086 34.114179 L 3999.083119 639.889173 L 3994.963952 639.889173 L 3994.963952 641.948757 L 4368.006012 641.948757 C 4398.127421 641.948757 4417.950912 672.070165 4414.089193 709.915012 L 4415.118985 711.974595 C 4424.902006 871.07742 4386.027368 1017.0504 4261.937462 1141.912649 L 4578.083528 1140.882858 L 4648.109367 1140.882858 L 4649.911503 1140.110514 C 4653.000878 1135.991347 4657.120045 1131.87218 4659.951972 1129.040253 C 4800.00365 985.8992 4899.121105 789.98132 4908.904127 491.084266 C 4908.904127 471.003327 4909.933919 449.892596 4908.904127 429.039313 C 4908.904127 405.096655 4907.874335 380.896549 4906.0722 354.894308 L 4907.101991 354.894308 L 4907.101991 346.913422 L 4960.90861 300.057897 L 4963.997985 297.998314 L 4975.068247 287.957844 L 4997.981113 266.074769 L 4968.117152 292.077011 L 4962.968193 295.93873 L 4914.053086 337.902744 C 4911.993502 338.932535 4911.993502 326.060139 4910.96371 327.08993 C 4904.012616 329.921858 4897.061522 330.951649 4890.882771 329.921858 C 4883.931677 329.921858 4878.010374 326.060139 4873.891207 320.91118 C 4873.891207 319.881388 4873.118864 318.079253 4872.089072 317.049461 L 4846.08683 250.112997 L 4844.027247 243.934247 C 4835.016569 242.904455 4827.035683 241.874663 4820.084589 240.072528 L 4795.112139 261.955602 C 4795.112139 266.074769 4795.112139 269.936489 4795.112139 274.055656 C 4790.992972 295.93873 4769.109897 313.960086 4745.939583 313.960086 C 4723.026717 313.960086 4708.094736 295.93873 4711.956455 274.055656 C 4715.045831 253.974716 4734.096978 236.983153 4754.950261 234.923569 L 4780.952502 210.980911 C 4774.001408 197.078722 4775.0312 175.967992 4785.071669 147.906167 C 4821.11438 78.91012 4883.931677 53.93767 4965.027777 55.997253 C 5020.893979 65.007931 5054.104763 129.112467 5080.879348 209.951119 C 5084.998515 230.032058 5063.115441 239.042736 5022.953563 241.874663 C 5060.026066 252.944925 5092.979401 294.908938 5123.873154 363.904985 C 5149.103052 355.924099 5184.888315 399.947696 5203.939462 463.022441 C 5222.990609 525.067394 5220.931026 585.052763 5199.047951 599.984743 C 5212.95014 658.940321 5227.109776 725.10444 5239.982173 794.872831 C 5432.038334 887.039192 5509.015267 1019.882327 5427.919167 1026.061078 C 5420.968072 1027.09087 5412.987186 1027.09087 5402.946717 1027.09087 Z M 2876.09522 691.121313 L 2776.977765 691.121313 C 2723.94349 691.121313 2679.919893 734.887462 2679.919893 787.921737 L 2679.919893 788.951528 C 2679.919893 843.015595 2723.94349 886.009401 2776.977765 886.009401 L 2876.09522 886.009401 C 2928.872047 886.009401 2972.895645 843.015595 2972.895645 788.951528 L 2972.895645 787.921737 C 2972.895645 734.887462 2928.872047 691.121313 2876.09522 691.121313 Z M 3119.898416 117.012414 L 2701.030624 117.012414 C 2647.996349 117.012414 2603.972752 161.036011 2603.972752 214.070286 L 2603.972752 215.872422 C 2603.972752 268.906697 2647.996349 311.900502 2701.030624 311.900502 L 3119.898416 311.900502 C 3173.962483 311.900502 3216.956288 268.906697 3216.956288 215.872422 L 3216.956288 214.070286 C 3216.956288 161.036011 3173.962483 117.012414 3119.898416 117.012414 Z M 3215.926497 878.028514 L 3079.993986 878.028514 C 3026.959711 878.028514 2982.936114 922.052112 2982.936114 975.086387 L 2982.936114 976.888522 C 2982.936114 1029.922797 3026.959711 1072.916602 3079.993986 1072.916602 L 3215.926497 1072.916602 C 3269.990563 1072.916602 3312.984369 1029.922797 3312.984369 976.888522 L 3312.984369 975.086387 C 3312.984369 922.052112 3269.990563 878.028514 3215.926497 878.028514 Z M 5016.002468 242.904455 L 5014.972677 249.083206 L 5021.923771 242.904455 C 5020.121635 242.904455 5018.062052 242.904455 5016.002468 242.904455 Z M 5124.902946 976.888522 L 5129.022113 970.96722 Z M 5129.022113 970.96722 C 5132.883832 965.045917 5137.002999 959.896958 5141.122166 953.975656 C 5137.002999 959.896958 5132.883832 965.045917 5129.022113 970.96722 Z M 5147.043468 944.964978 C 5152.964771 936.984092 5158.886073 927.973414 5165.064824 918.962736 C 5158.886073 927.973414 5152.964771 936.984092 5147.043468 944.964978 Z M 5147.043468 944.964978 " stroke="#fefefe" stroke-width="67.015999" stroke-opacity="1" stroke-miterlimit="4"/></g><path fill="#f7462e" d="M 231.117188 12.207031 C 231.101562 12.222656 231.101562 12.253906 231.085938 12.269531 Z M 226.367188 25.015625 L 225.277344 25.027344 Z M 237.792969 23.300781 C 238.613281 24.117188 239.023438 25.316406 238.78125 26.667969 C 238.371094 29.109375 236.0625 31.082031 233.621094 31.082031 C 231.195312 31.082031 229.554688 29.109375 229.980469 26.667969 C 229.980469 26.605469 229.996094 26.546875 230.011719 26.46875 C 229.675781 26.742188 229.34375 26.988281 228.976562 27.214844 L 215.839844 27.246094 C 215.140625 29.351562 213.046875 30.960938 210.847656 30.960938 C 208.433594 30.960938 206.796875 29.003906 207.191406 26.578125 L 206.796875 26.578125 C 206.8125 26.578125 206.8125 26.5625 206.8125 26.546875 C 206.960938 25.621094 207.386719 24.757812 207.964844 24.011719 L 207.917969 24.011719 C 207.113281 24.011719 206.445312 23.359375 206.445312 22.539062 L 206.445312 22.527344 C 206.445312 21.722656 207.113281 21.054688 207.917969 21.054688 L 207.722656 21.054688 C 208.3125 20.871094 208.738281 20.308594 208.738281 19.65625 L 208.738281 19.644531 C 208.738281 18.914062 208.207031 18.308594 207.507812 18.203125 L 201.925781 18.203125 C 201.121094 18.203125 200.46875 17.535156 200.46875 16.730469 L 200.46875 16.699219 C 200.46875 15.894531 201.121094 15.242188 201.925781 15.242188 L 207.886719 15.242188 L 208.375 12.449219 L 206.765625 12.449219 C 205.960938 12.449219 205.308594 11.796875 205.308594 10.992188 L 205.308594 10.964844 C 205.308594 10.160156 205.960938 9.492188 206.765625 9.492188 L 208.875 9.492188 L 209.085938 8.234375 L 218.070312 8.234375 L 216.492188 17.425781 L 216.429688 17.425781 L 216.429688 17.457031 L 222.089844 17.457031 C 222.546875 17.457031 222.847656 17.914062 222.789062 18.488281 L 222.804688 18.519531 C 222.953125 20.933594 222.363281 23.148438 220.480469 25.042969 L 225.277344 25.027344 L 226.339844 25.027344 L 226.367188 25.015625 C 226.414062 24.953125 226.476562 24.890625 226.519531 24.847656 C 228.644531 22.675781 230.148438 19.703125 230.296875 15.167969 C 230.296875 14.863281 230.3125 14.542969 230.296875 14.226562 C 230.296875 13.863281 230.28125 13.496094 230.253906 13.101562 L 230.269531 13.101562 L 230.269531 12.980469 L 231.085938 12.269531 L 231.132812 12.238281 L 231.300781 12.085938 L 231.648438 11.753906 L 231.195312 12.148438 L 231.117188 12.207031 L 230.375 12.84375 C 230.34375 12.859375 230.34375 12.664062 230.328125 12.679688 C 230.222656 12.722656 230.117188 12.738281 230.023438 12.722656 C 229.917969 12.722656 229.828125 12.664062 229.765625 12.585938 C 229.765625 12.570312 229.753906 12.542969 229.738281 12.527344 L 229.34375 11.511719 L 229.3125 11.417969 C 229.175781 11.402344 229.054688 11.386719 228.949219 11.359375 L 228.570312 11.691406 C 228.570312 11.753906 228.570312 11.8125 228.570312 11.875 C 228.507812 12.207031 228.175781 12.480469 227.824219 12.480469 C 227.476562 12.480469 227.25 12.207031 227.308594 11.875 C 227.355469 11.570312 227.644531 11.3125 227.960938 11.28125 L 228.355469 10.917969 C 228.25 10.707031 228.265625 10.386719 228.417969 9.960938 C 228.964844 8.914062 229.917969 8.535156 231.148438 8.566406 C 231.996094 8.703125 232.5 9.675781 232.90625 10.902344 C 232.96875 11.207031 232.636719 11.34375 232.027344 11.386719 C 232.589844 11.554688 233.089844 12.191406 233.558594 13.238281 C 233.941406 13.117188 234.484375 13.785156 234.773438 14.742188 C 235.0625 15.683594 235.03125 16.59375 234.699219 16.820312 C 234.910156 17.714844 235.125 18.71875 235.320312 19.777344 C 238.234375 21.175781 239.402344 23.191406 238.171875 23.285156 C 238.066406 23.300781 237.945312 23.300781 237.792969 23.300781 Z M 199.453125 18.203125 L 197.949219 18.203125 C 197.144531 18.203125 196.476562 18.867188 196.476562 19.671875 L 196.476562 19.6875 C 196.476562 20.507812 197.144531 21.160156 197.949219 21.160156 L 199.453125 21.160156 C 200.253906 21.160156 200.921875 20.507812 200.921875 19.6875 L 200.921875 19.671875 C 200.921875 18.867188 200.253906 18.203125 199.453125 18.203125 Z M 203.152344 9.492188 L 196.796875 9.492188 C 195.992188 9.492188 195.324219 10.160156 195.324219 10.964844 L 195.324219 10.992188 C 195.324219 11.796875 195.992188 12.449219 196.796875 12.449219 L 203.152344 12.449219 C 203.972656 12.449219 204.625 11.796875 204.625 10.992188 L 204.625 10.964844 C 204.625 10.160156 203.972656 9.492188 203.152344 9.492188 Z M 204.609375 21.039062 L 202.546875 21.039062 C 201.742188 21.039062 201.074219 21.707031 201.074219 22.511719 L 201.074219 22.539062 C 201.074219 23.34375 201.742188 23.996094 202.546875 23.996094 L 204.609375 23.996094 C 205.429688 23.996094 206.082031 23.34375 206.082031 22.539062 L 206.082031 22.511719 C 206.082031 21.707031 205.429688 21.039062 204.609375 21.039062 Z M 231.921875 11.402344 L 231.90625 11.496094 L 232.011719 11.402344 C 231.984375 11.402344 231.953125 11.402344 231.921875 11.402344 Z M 233.574219 22.539062 L 233.636719 22.449219 Z M 233.636719 22.449219 C 233.695312 22.359375 233.757812 22.28125 233.820312 22.191406 C 233.757812 22.28125 233.695312 22.359375 233.636719 22.449219 Z M 233.910156 22.054688 C 234 21.933594 234.089844 21.796875 234.183594 21.660156 C 234.089844 21.796875 234 21.933594 233.910156 22.054688 Z M 233.910156 22.054688 " fill-opacity="1" fill-rule="evenodd"/><path fill="#fefefe" d="M 236.375 26.640625 C 236.328125 26.917969 236.230469 27.1875 236.078125 27.445312 C 235.925781 27.703125 235.738281 27.929688 235.503906 28.125 C 235.273438 28.324219 235.019531 28.476562 234.746094 28.582031 C 234.46875 28.6875 234.191406 28.742188 233.914062 28.742188 C 233.632812 28.742188 233.375 28.6875 233.136719 28.582031 C 232.894531 28.476562 232.695312 28.324219 232.53125 28.125 C 232.367188 27.929688 232.253906 27.703125 232.191406 27.445312 C 232.128906 27.1875 232.121094 26.917969 232.167969 26.640625 C 232.21875 26.359375 232.316406 26.09375 232.46875 25.835938 C 232.617188 25.578125 232.808594 25.347656 233.039062 25.152344 C 233.273438 24.957031 233.523438 24.804688 233.800781 24.695312 C 234.078125 24.589844 234.355469 24.535156 234.632812 24.535156 C 234.914062 24.535156 235.171875 24.589844 235.410156 24.695312 C 235.652344 24.804688 235.851562 24.957031 236.015625 25.152344 C 236.179688 25.347656 236.292969 25.578125 236.355469 25.835938 C 236.417969 26.09375 236.425781 26.359375 236.375 26.640625 Z M 236.375 26.640625 " fill-opacity="1" fill-rule="nonzero"/><path fill="#fefefe" d="M 213.601562 26.515625 C 213.554688 26.796875 213.453125 27.0625 213.304688 27.320312 C 213.152344 27.578125 212.960938 27.804688 212.730469 28.003906 C 212.5 28.199219 212.246094 28.351562 211.96875 28.457031 C 211.695312 28.566406 211.417969 28.617188 211.136719 28.617188 C 210.859375 28.617188 210.597656 28.566406 210.359375 28.457031 C 210.121094 28.351562 209.917969 28.199219 209.757812 28.003906 C 209.59375 27.804688 209.480469 27.578125 209.417969 27.320312 C 209.355469 27.0625 209.347656 26.796875 209.394531 26.515625 C 209.441406 26.238281 209.542969 25.96875 209.691406 25.710938 C 209.84375 25.453125 210.035156 25.226562 210.265625 25.03125 C 210.496094 24.832031 210.75 24.679688 211.027344 24.574219 C 211.300781 24.46875 211.578125 24.414062 211.859375 24.414062 C 212.136719 24.414062 212.394531 24.46875 212.636719 24.574219 C 212.875 24.679688 213.078125 24.832031 213.238281 25.03125 C 213.402344 25.226562 213.515625 25.453125 213.578125 25.710938 C 213.640625 25.96875 213.648438 26.238281 213.601562 26.515625 Z M 213.601562 26.515625 " fill-opacity="1" fill-rule="nonzero"/><path fill="#f7462e" d="M 192.882812 43.359375 L 195.25 43.359375 C 196.8125 43.359375 197.660156 42.507812 197.796875 40.929688 L 198.253906 35.96875 C 198.390625 34.390625 197.707031 33.542969 196.144531 33.542969 L 193.777344 33.542969 Z M 194.566406 41.960938 L 195.203125 34.9375 L 195.992188 34.9375 C 196.492188 34.9375 196.765625 35.195312 196.707031 35.894531 L 196.234375 41.007812 C 196.175781 41.703125 195.855469 41.960938 195.355469 41.960938 Z M 198.617188 43.359375 L 202.867188 43.359375 L 203.003906 41.960938 L 200.300781 41.960938 L 200.589844 38.941406 L 202.714844 38.941406 L 202.851562 37.53125 L 200.710938 37.53125 L 200.953125 34.9375 L 203.640625 34.9375 L 203.761719 33.542969 L 199.511719 33.542969 Z M 203.761719 43.359375 L 207.886719 43.359375 L 208.007812 41.960938 L 205.445312 41.960938 L 206.21875 33.542969 L 204.65625 33.542969 Z M 208.632812 43.359375 L 210.195312 43.359375 L 211.089844 33.542969 L 209.527344 33.542969 Z M 212.441406 43.359375 L 214.503906 43.359375 L 216.902344 33.542969 L 215.472656 33.542969 L 213.761719 41.15625 L 213.730469 41.15625 L 213.410156 33.542969 L 211.832031 33.542969 Z M 216.75 43.359375 L 220.996094 43.359375 L 221.132812 41.960938 L 218.449219 41.960938 L 218.722656 38.941406 L 220.84375 38.941406 L 220.980469 37.53125 L 218.84375 37.53125 L 219.085938 34.9375 L 221.769531 34.9375 L 221.890625 33.542969 L 217.644531 33.542969 Z M 221.890625 43.359375 L 223.457031 43.359375 L 223.835938 39.15625 L 224.367188 39.15625 C 225.078125 39.15625 225.320312 39.445312 225.246094 40.355469 L 225.078125 42.160156 C 225.003906 42.964844 225.046875 43.117188 225.109375 43.359375 L 226.6875 43.359375 C 226.566406 42.992188 226.582031 42.644531 226.625 42.175781 L 226.792969 40.445312 C 226.882812 39.335938 226.703125 38.609375 225.945312 38.367188 L 225.945312 38.335938 C 226.671875 38.0625 227.050781 37.410156 227.140625 36.394531 L 227.203125 35.800781 C 227.339844 34.285156 226.703125 33.542969 225.09375 33.542969 L 222.789062 33.542969 Z M 223.957031 37.742188 L 224.214844 34.9375 L 224.925781 34.9375 C 225.472656 34.9375 225.6875 35.253906 225.625 35.953125 L 225.5625 36.710938 C 225.488281 37.5 225.109375 37.742188 224.53125 37.742188 Z M 228.796875 43.359375 L 230.359375 43.359375 L 230.738281 39.183594 L 233.136719 33.542969 L 231.617188 33.542969 L 230.238281 37.136719 L 230.207031 37.136719 L 229.464844 33.542969 L 227.808594 33.542969 L 229.175781 39.183594 Z M 228.796875 43.359375 " fill-opacity="1" fill-rule="evenodd"/><g clip-path="url(#0031c228e8)"><path fill="#f1f2eb" d="M 102.4375 42.65625 L 97.683594 47.21875 C 97.566406 47.332031 97.519531 47.503906 97.570312 47.660156 L 98.046875 49.179688 C 98.078125 49.28125 98.136719 49.367188 98.21875 49.433594 L 103.011719 53.167969 C 103.160156 53.285156 103.371094 53.265625 103.492188 53.121094 L 103.597656 53 C 103.710938 52.867188 103.902344 52.832031 104.058594 52.914062 L 104.761719 53.285156 C 104.871094 53.34375 105 53.359375 105.121094 53.332031 L 111.472656 51.894531 C 111.625 51.859375 111.722656 51.703125 111.6875 51.546875 L 111.609375 51.21875 C 111.570312 51.042969 111.625 50.863281 111.753906 50.742188 L 114.375 48.261719 C 114.539062 48.105469 114.542969 47.847656 114.390625 47.683594 L 109.335938 42.410156 C 109.195312 42.265625 108.96875 42.257812 108.824219 42.390625 L 108.0625 43.085938 C 107.914062 43.226562 107.6875 43.238281 107.519531 43.121094 C 107.25 42.933594 106.683594 42.695312 105.996094 42.695312 C 105.226562 42.695312 104.644531 43.035156 104.292969 43.253906 C 104.128906 43.355469 103.917969 43.347656 103.757812 43.234375 L 102.898438 42.625 C 102.757812 42.523438 102.566406 42.535156 102.4375 42.65625 Z M 102.4375 42.65625 " fill-opacity="1" fill-rule="nonzero"/></g><g clip-path="url(#936f19ba8c)"><path fill="#0fb1ea" d="M 102.65625 42.980469 L 98.449219 48.808594 L 103.4375 52.640625 L 107.496094 46.699219 Z M 102.65625 42.980469 " fill-opacity="1" fill-rule="nonzero"/></g><g clip-path="url(#2c1567ec88)"><path fill="#094459" d="M 102.65625 42.980469 L 98 47.585938 L 98.449219 48.808594 Z M 102.65625 42.980469 " fill-opacity="1" fill-rule="nonzero"/></g><path fill="#094459" d="M 105.589844 46.527344 C 105.5625 46.527344 105.535156 46.515625 105.515625 46.5 C 105.460938 46.457031 105.449219 46.378906 105.492188 46.320312 C 105.503906 46.308594 106.566406 44.886719 106.441406 43.964844 C 106.414062 43.746094 106.320312 43.578125 106.160156 43.457031 C 106 43.332031 105.816406 43.289062 105.601562 43.316406 C 104.695312 43.449219 103.644531 44.878906 103.632812 44.894531 C 103.59375 44.949219 103.515625 44.960938 103.457031 44.917969 C 103.402344 44.878906 103.390625 44.800781 103.433594 44.742188 C 103.480469 44.679688 104.558594 43.214844 105.566406 43.066406 C 105.847656 43.027344 106.097656 43.089844 106.3125 43.253906 C 106.523438 43.417969 106.652344 43.644531 106.691406 43.929688 C 106.828125 44.957031 105.734375 46.414062 105.6875 46.476562 C 105.664062 46.507812 105.628906 46.527344 105.589844 46.527344 Z M 105.589844 46.527344 " fill-opacity="1" fill-rule="nonzero"/><path fill="#f7ce26" d="M 103.273438 45.761719 L 105 52.773438 L 111.089844 51.324219 L 109.183594 44.359375 Z M 103.273438 45.761719 " fill-opacity="1" fill-rule="nonzero"/><path fill="#094459" d="M 103.273438 45.761719 L 103.746094 52.34375 L 105 52.773438 Z M 103.273438 45.761719 " fill-opacity="1" fill-rule="nonzero"/><path fill="#094459" d="M 105.226562 46.378906 C 105.171875 46.378906 105.121094 46.339844 105.105469 46.28125 C 105.085938 46.207031 104.667969 44.425781 105.203125 43.542969 C 105.347656 43.300781 105.558594 43.144531 105.816406 43.082031 C 106.078125 43.019531 106.332031 43.066406 106.570312 43.21875 C 107.4375 43.769531 107.84375 45.550781 107.859375 45.628906 C 107.875 45.695312 107.832031 45.761719 107.765625 45.777344 C 107.699219 45.792969 107.632812 45.75 107.617188 45.683594 C 107.613281 45.664062 107.214844 43.925781 106.4375 43.433594 C 106.253906 43.316406 106.070312 43.28125 105.875 43.328125 C 105.675781 43.375 105.527344 43.488281 105.414062 43.675781 C 104.933594 44.46875 105.34375 46.203125 105.347656 46.222656 C 105.363281 46.289062 105.324219 46.359375 105.257812 46.375 C 105.246094 46.378906 105.238281 46.378906 105.226562 46.378906 Z M 105.226562 46.378906 " fill-opacity="1" fill-rule="nonzero"/><g clip-path="url(#738e348c33)"><path fill="#f07423" d="M 104.355469 46.808594 L 109.089844 52.195312 L 113.820312 48.039062 L 108.941406 42.773438 Z M 104.355469 46.808594 " fill-opacity="1" fill-rule="nonzero"/></g><path fill="#094459" d="M 104.355469 46.808594 L 107.789062 52.410156 L 109.089844 52.195312 Z M 104.355469 46.808594 " fill-opacity="1" fill-rule="nonzero"/><g clip-path="url(#eab7268488)"><path fill="#094459" d="M 106.304688 46.445312 C 106.269531 46.445312 106.238281 46.429688 106.210938 46.402344 C 106.160156 46.34375 104.972656 44.964844 105.042969 43.933594 C 105.0625 43.648438 105.171875 43.410156 105.375 43.234375 C 105.578125 43.054688 105.824219 42.976562 106.105469 42.996094 C 107.121094 43.074219 108.300781 44.460938 108.351562 44.519531 C 108.394531 44.574219 108.386719 44.652344 108.335938 44.699219 C 108.285156 44.746094 108.207031 44.738281 108.160156 44.683594 C 108.148438 44.671875 107 43.320312 106.085938 43.25 C 105.871094 43.234375 105.691406 43.289062 105.539062 43.425781 C 105.386719 43.558594 105.304688 43.730469 105.289062 43.949219 C 105.230469 44.878906 106.386719 46.222656 106.398438 46.234375 C 106.445312 46.285156 106.4375 46.367188 106.386719 46.414062 C 106.363281 46.433594 106.335938 46.445312 106.304688 46.445312 Z M 106.304688 46.445312 " fill-opacity="1" fill-rule="nonzero"/></g><g clip-path="url(#b632e994e0)"><path fill="#094459" d="M 146.199219 48.390625 L 145.671875 47.203125 L 145.851562 48.316406 C 145.898438 48.609375 145.816406 48.859375 145.601562 49.070312 L 142.265625 52.410156 L 143.523438 52.960938 C 143.574219 52.988281 143.632812 53.003906 143.691406 53.003906 C 143.859375 53 143.984375 52.925781 144.0625 52.773438 L 146.1875 48.773438 C 146.257812 48.648438 146.261719 48.519531 146.199219 48.390625 Z M 146.199219 48.390625 " fill-opacity="1" fill-rule="nonzero"/></g><path fill="#094459" d="M 140.789062 48.199219 C 140.871094 48.179688 140.941406 48.140625 141 48.082031 C 141.0625 48.019531 141.101562 47.949219 141.121094 47.867188 C 141.128906 47.824219 141.121094 47.785156 141.097656 47.75 C 141.074219 47.730469 141.046875 47.722656 141.019531 47.726562 C 141.007812 47.726562 140.992188 47.726562 140.980469 47.726562 C 140.800781 47.769531 140.691406 47.878906 140.648438 48.058594 C 140.632812 48.105469 140.636719 48.144531 140.671875 48.175781 C 140.707031 48.210938 140.742188 48.21875 140.789062 48.199219 Z M 140.789062 48.199219 " fill-opacity="1" fill-rule="nonzero"/><path fill="#094459" d="M 141.089844 50.09375 C 140.992188 50.101562 140.90625 50.140625 140.839844 50.214844 C 140.71875 50.335938 140.691406 50.488281 140.746094 50.542969 C 140.777344 50.570312 140.816406 50.578125 140.859375 50.566406 C 140.941406 50.550781 141.015625 50.511719 141.074219 50.449219 C 141.136719 50.390625 141.175781 50.316406 141.191406 50.234375 C 141.203125 50.191406 141.195312 50.15625 141.167969 50.121094 C 141.144531 50.101562 141.121094 50.089844 141.089844 50.09375 Z M 141.089844 50.09375 " fill-opacity="1" fill-rule="nonzero"/><path fill="#094459" d="M 144.070312 48.839844 L 141.226562 46 C 141.183594 45.957031 141.140625 45.957031 141.097656 46 L 137.773438 49.324219 C 137.730469 49.367188 137.730469 49.410156 137.773438 49.457031 L 140.613281 52.296875 C 140.65625 52.339844 140.699219 52.339844 140.742188 52.296875 L 144.070312 48.972656 C 144.113281 48.925781 144.113281 48.882812 144.070312 48.839844 Z M 140.285156 48 C 140.355469 47.644531 140.566406 47.433594 140.921875 47.363281 C 141 47.347656 141.078125 47.347656 141.15625 47.371094 C 141.234375 47.394531 141.300781 47.433594 141.359375 47.488281 C 141.414062 47.546875 141.453125 47.613281 141.476562 47.691406 C 141.5 47.769531 141.503906 47.847656 141.484375 47.925781 C 141.453125 48.085938 141.382812 48.226562 141.261719 48.339844 C 141.148438 48.460938 141.007812 48.535156 140.847656 48.5625 C 140.816406 48.566406 140.785156 48.570312 140.753906 48.570312 C 140.621094 48.574219 140.507812 48.527344 140.410156 48.4375 C 140.292969 48.3125 140.253906 48.167969 140.285156 48 Z M 141.558594 50.292969 C 141.527344 50.457031 141.453125 50.59375 141.335938 50.710938 C 141.21875 50.828125 141.082031 50.902344 140.917969 50.929688 C 140.886719 50.9375 140.855469 50.9375 140.824219 50.9375 C 140.691406 50.941406 140.578125 50.898438 140.484375 50.804688 C 140.273438 50.59375 140.3125 50.21875 140.578125 49.953125 C 140.84375 49.6875 141.21875 49.644531 141.429688 49.859375 C 141.546875 49.980469 141.589844 50.125 141.558594 50.292969 Z M 142.308594 49.339844 C 142.292969 49.445312 142.230469 49.5 142.125 49.5 C 142.117188 49.5 142.105469 49.496094 142.097656 49.496094 L 139.691406 49.164062 C 139.570312 49.148438 139.519531 49.078125 139.535156 48.957031 C 139.550781 48.835938 139.621094 48.78125 139.742188 48.796875 L 142.148438 49.128906 C 142.269531 49.148438 142.324219 49.21875 142.308594 49.339844 Z M 142.308594 49.339844 " fill-opacity="1" fill-rule="nonzero"/><g clip-path="url(#c5d5822d42)"><path fill="#094459" d="M 145.007812 45.425781 C 144.996094 45.351562 144.964844 45.28125 144.914062 45.222656 C 144.761719 45.277344 144.632812 45.363281 144.519531 45.480469 C 144.371094 45.613281 144.28125 45.777344 144.242188 45.972656 C 144.300781 46.054688 144.339844 46.148438 144.355469 46.25 C 144.375 46.351562 144.367188 46.453125 144.332031 46.550781 C 144.300781 46.648438 144.25 46.734375 144.175781 46.808594 C 144.101562 46.882812 144.015625 46.933594 143.917969 46.964844 C 143.820312 47 143.71875 47.007812 143.617188 46.988281 C 143.515625 46.972656 143.421875 46.933594 143.335938 46.875 C 143.253906 46.8125 143.1875 46.738281 143.140625 46.644531 C 143.09375 46.550781 143.070312 46.453125 143.070312 46.351562 C 143.070312 46.339844 143.074219 46.328125 143.074219 46.316406 C 142.960938 45.867188 143.101562 45.335938 143.460938 44.867188 L 141.695312 44.582031 C 141.667969 44.578125 141.644531 44.574219 141.617188 44.574219 C 141.476562 44.574219 141.359375 44.625 141.261719 44.726562 L 136.871094 49.117188 C 136.773438 49.210938 136.722656 49.324219 136.71875 49.457031 C 136.710938 49.585938 136.753906 49.699219 136.847656 49.792969 L 140.277344 53.222656 C 140.363281 53.308594 140.46875 53.351562 140.59375 53.351562 C 140.734375 53.347656 140.851562 53.296875 140.953125 53.199219 L 145.34375 48.808594 C 145.464844 48.6875 145.511719 48.542969 145.488281 48.375 Z M 144.332031 49.230469 L 141.003906 52.558594 C 140.914062 52.648438 140.804688 52.691406 140.679688 52.691406 C 140.550781 52.691406 140.441406 52.648438 140.351562 52.558594 L 137.511719 49.714844 C 137.421875 49.625 137.375 49.515625 137.375 49.390625 C 137.375 49.261719 137.421875 49.152344 137.511719 49.0625 L 140.835938 45.738281 C 140.925781 45.648438 141.035156 45.601562 141.164062 45.601562 C 141.289062 45.601562 141.398438 45.648438 141.488281 45.738281 L 144.332031 48.578125 C 144.421875 48.667969 144.464844 48.777344 144.464844 48.90625 C 144.464844 49.03125 144.421875 49.140625 144.332031 49.230469 Z M 144.332031 49.230469 " fill-opacity="1" fill-rule="nonzero"/></g><g clip-path="url(#2e67f60248)"><path fill="#094459" d="M 145.632812 44.589844 C 145.46875 44.433594 145.273438 44.359375 145.050781 44.367188 C 144.964844 44.367188 144.878906 44.375 144.792969 44.394531 C 144.460938 44.476562 144.171875 44.640625 143.933594 44.890625 C 143.425781 45.398438 143.261719 46.070312 143.546875 46.484375 C 143.582031 46.542969 143.628906 46.574219 143.695312 46.589844 C 143.757812 46.601562 143.816406 46.589844 143.871094 46.554688 C 143.925781 46.515625 143.957031 46.464844 143.96875 46.402344 C 143.980469 46.335938 143.964844 46.277344 143.925781 46.226562 C 143.792969 46.03125 143.882812 45.59375 144.257812 45.21875 C 144.433594 45.03125 144.644531 44.910156 144.894531 44.84375 C 144.945312 44.832031 144.996094 44.828125 145.046875 44.828125 C 145.144531 44.820312 145.230469 44.851562 145.304688 44.917969 C 145.417969 45.03125 145.398438 45.222656 145.375 45.328125 C 145.367188 45.363281 145.355469 45.402344 145.34375 45.4375 L 145.46875 46.140625 L 145.535156 46.050781 C 145.675781 45.863281 145.773438 45.65625 145.828125 45.425781 C 145.902344 45.089844 145.832031 44.792969 145.632812 44.589844 Z M 145.632812 44.589844 " fill-opacity="1" fill-rule="nonzero"/></g></svg>
            </div>

            <form action="{{ route('madella_submit') }}" id="form" class="relative" method="post" enctype="multipart/form-data">
                <input type="hidden" id="purchase_value" value="{{ request()->amount }}">
                <h3 class="tfont-medium tmb-4 tpt-5 ttext-center">ORDER FORM</h3>

                @csrf
                <div class="tw-full tflex tmb-3">
                    <div class="tw-1/2 tmr-1">
                        <label for="full_name" class="tfont-medium ttext-sm tmb-2 ttext-black-100">Full Name</label>
                        <input required type="text" name="full_name" id="full_name" value="{{ old('full_name') }}" class="browser-default input-control">
                    </div>
                    <div class="tw-1/2 tml-1 trelative">
                        @error('phone_number')
                            <span class="tabsolute tfont-bold ttext-red-600 ttext-xs" style="bottom: -29%;left: 1%;">{{ $message }}</span>
                        @enderror
                        <label for="phone_number" class="tfont-medium ttext-sm tmb-2 ttext-black-100">Phone Number</label>
                        <input required type="number" name="phone_number" id="phone_number" onkeyup="allnumeric(this)" value="{{ old('phone_number') }}" class="browser-default input-control">
                    </div>
                </div><!--Fullname & Phone Number -->
                <div class="tw-full tflex tmb-3">
                    <div class="tw-auto tmr-1">
                        <label for="address" class=" ttext-sm tmb-2 ttext-black-100">
                            <span class="tfont-medium">Complete Address</span>
                            <small class="ttext-gray-600">(St./House No. | blk & lot/ Subdv / Barangay / City / Province)</small>
                        </label>
                        <input required type="text" name="address" id="address" value="{{ old('address') }}" class="browser-default input-control">
                    </div>
                </div><!--Address -->

                <div class=" tmb-2 tp-3 trelative" >
                    
                    <div class="tflex tflex-wrap">

                        <div class="tw-full tp-1 tmt-2 trelative">
                            <label class="tblock tborder-2 tpb-12 tpx-3 trounded" style="border-color: #ee4d2d;">
                                <input type="checkbox" id="promo1" name="promo" class="promo" checked="" value="SmartLight_3pcs|1199|1pc">
                                <span class="ttext-gray-900 tfont-medium ttext-sm" style="top: 11px;">3pcs Smart Light</span>
                                <span class="tabsolute tfont-medium ttext-grey-900" style="bottom: 10%; left: 10%;color: #000000;">(399/each)</span>
                                <span class="tabsolute theme-bg tw-10" style="
                                    height: 28px;
                                    bottom: 4%;
                                    width: 57px;
                                    right: 5%;
                                    border: 1px solid red;
                                    border-top-left-radius: 10px;
                                    border-top-right-radius: 10px;
                                    ">
                                <span class="tblock ttext-white ttext-center tfont-bold ttext-lg" style="margin-top: 1px;">₱1199</span>

                                </span>
                            </label>
                            <div class="tabsolute" style="top: -6px; left: 38%%;">
                                <div class="theme-bg tfont-medium tpx-4 trounded ttext-sm ttext-white">
                                    BEST SELLER
                                </div>
                            </div>
                        </div><!-- PROMO 1-->

                        <div class="tw-full tp-1 tmt-2 trelative">
                            <label class="tblock tborder-2 tpb-12 tpx-3 trounded" style="border-color: #ee4d2d;">
                                <input type="checkbox" id="promo2" name="promo" class="promo"  value="SmartLight_2pcs|899|2pc">
                                <span class="ttext-gray-900 tfont-medium ttext-sm" style="top: 11px;">2pcs Smart Light</span>
                                <span class="tabsolute tfont-medium ttext-grey-900" style="bottom: 10%; left: 10%;color: #000000;">(449/each)</span>
                                <span class="tabsolute theme-bg tw-10" style="
                                    height: 28px;
                                    bottom: 4%;
                                    width: 57px;
                                    right: 5%;
                                    border: 1px solid red;
                                    border-top-left-radius: 10px;
                                    border-top-right-radius: 10px;
                                    ">
                                    <span class="tblock ttext-white ttext-center tfont-bold ttext-lg" style="margin-top: 1px;">₱899</span>

                                </span>
                            </label>
                          
                        </div><!-- PROMO 2-->
                        
                        <div class="tw-full tp-1 tmt-2 trelative">
                            <label class="tblock tborder-2 tpb-12 tpx-3 trounded" style="border-color: #ee4d2d;">
                                <input type="checkbox" id="promo3" name="promo" class="promo" value="SmartLight_1pcs|549|1pc">
                                <span class="ttext-gray-900 tfont-medium ttext-sm" style="top: 11px;">1pc Smart Light</span>
                                <span class="tabsolute tfont-medium ttext-grey-900" style="bottom: 10%; left: 10%;color: #000000;">(549/each)</span>

                                <span class="tabsolute theme-bg tw-10" style="
                                    height: 28px;
                                    bottom: 4%;
                                    width: 57px;
                                    right: 5%;
                                    border: 1px solid red;
                                    border-top-left-radius: 10px;
                                    border-top-right-radius: 10px;
                                    ">
                                    <span class="tblock ttext-white ttext-center tfont-bold ttext-lg" style="margin-top: 1px;">₱549</span>
                                </span>
                            </label>
                        </div><!-- PROMO 3-->

                     




                        {{-- <div class="tflex titems-center tw-full tjustify-center">
                            <label>
                                <input type="checkbox" id="promo4" name="promo" class="promo" checked="" value="MissTisa_1pc|499|1pc">
                                <span class="ttext-gray-900" style="font-size: 13px;">
                                    <span class="tfont-medium ttext-sm">₱499</span>
                                    MissTisa Melasma Remover 1 Set
                                </span>
                            </label>
                        </div><!-- PROMO 4-->
                        <div class="tflex titems-center tw-full tjustify-center">
                            <label>
                                <input type="checkbox" id="promo3" name="promo" class="promo" value="MissTisa_2pcs|849|2pcs">
                                <span class="ttext-gray-900" style="font-size: 13px;">
                                    <span class="tfont-medium ttext-sm">₱849</span>
                                    MissTisa Melasma Remover 2 Set
                                </span>
                            </label>
                        </div><!-- PROMO 3 --> --}}
                    </div>
                
                    @error('promo')
                        <span class="tabsolute tfont-bold ttext-red-600 ttext-xs" style="bottom: -29%;left: 32%;">{{ $message }}</span>
                    @enderror
                </div><!-- ORDER PROMO -->

                <div class="tmt-3 ttext-right tw-full">
                    <span class="ttext-gray-900" style="font-size: 16px;">
                        <span class="tfont-medium">TOTAL:</span>
                        <span class="tfont-medium">₱</span>
                        <span id="total" class="tfont-medium t-ml-1">1199</span>
                    </span>
                </div>
                <div class="tw-full ">
                    <button  class="theme-bg focus:tbg-pink-500 trelative tshadow tfont-medium tmt-4 tpy-3 trounded-full ttext-2xl ttext-white tw-full waves-effect z-depth-5" id="submit_btn">
                        <span>Checkout Order</span>
                    </button>
                    <span  class="theme-bg thidden focus:tbg-pink-500 trelative ttext-center tshadow tfont-medium tmt-4 tpy-3 trounded-full ttext-2xl ttext-white tw-full waves-effect z-depth-5" id="loader">
                        <img src="{{ asset('/loader/four_dots_loader.svg') }}" style="display: initial; position: absolute; top: -29%; right: 35px;">
                        <span class="tmr-5">Loading please wait</span>
                    </span>
                </div><!-- Submit Order -->
            </form><!-- ORDER PROMO -->

            <div id="modal1" class="modal">
                <div class="modal-content" style="padding-bottom: 0px;">
                    <h4 class="tfont-medium ttext-3xl">Thank you</h4>
                    <h5 class="tfont-medium tmb-3 tmt-4 ttext-xl">Your order was completed successfully.</h5>
                
                    <p>We want to assure you that we are working diligently to process and ship your order as quickly as possible.</p><br>
                    <p><span class="tfont-medium">Metro Manila:</span>  1-3 working days.</p>
                    <p><span class="tfont-medium">Visayas & Mindanao:</span> 4-7 days.</p>
                    <br>
                    <p>
                        We truly appreciate your business and look forward to serving you again in the future.
                    </p><br>
                    <p class="tfont-medium">We appreciate your business!</p>

                </div>
                <div class="modal-footer">
                    <a href="" class="modal-close waves-effect waves-green btn-flat">Close</a>
                </div>
            </div> <!-- Modal  -->

            <button class="order_now theme-bg tabsolute  tbottom-0 tfixed tfont-medium tmb-5 tmt-4 tpy-3 trounded-full ttext-lg ttext-white tw-10/12 waves-effect zoom-in-out-box" 
                style="position: fixed; max-width: 480px; z-index: 999; opacity: 1; margin-left: auto; margin-right: auto; left: 0; right: 0;">
                ORDER NOW!
            </button>
        </div>
    </div>
@endsection

