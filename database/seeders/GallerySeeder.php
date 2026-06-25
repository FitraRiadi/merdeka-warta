<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $images = [
            'https://lh3.googleusercontent.com/aida-public/AB6AXuA9oK-FJ67qFTpUhyCXyUKhx4QOoHD6nD6Q9ak8x9tyjmBWDEV3-qUCpu14iNoYJTvj490t-WRXZNcL1gNlCSlxMoRCR5l2KC5tFD6pN9vD16YAnwOFwMPPcZiQi7oFSBybpkaGdx1CEiTpzSiO5czhwPd28D7k1qv_PnTf9gkG1g-UjrmjoL6u2o7JYQNkTBQl0njwHIe872FEpAdydrFWFHqBlYiqicdgYEFguuFeHb5Ozv2yul8Q4opITbc1JvikyJMklD2VOoN5buo',
            'https://lh3.googleusercontent.com/aida-public/AB6AXuBmef2Va4u0vh4JlU6iCDJX_MxJwsolSzmIcESpfl1Ve0FlQiM08O6sbtH1pZFjbku5jRXBQ-bN7KMTNIo9JXXSHVfeM4iX5L8DuQW5JHj-Inv4RANGrKVCxtA4MLdX9prt5FxMFRzei55_BHezHaP3K3pCnF3msCx5vkmNFb087T_P2YDk6XqLe4eNkTSkL7q51EHuAjDyKT1ZHiYd1-eP_lSuoYt8pC4tgJPQ-KXkOOMboRv8lmXm_OHvXjB2xH3b7n-6clv3kfo9v8A',
            'https://lh3.googleusercontent.com/aida-public/AB6AXuAz1basDdJuQMTcIcO5Zy7Mjgf-hFBTRfnAMEivO6BGK0lRcjrm_UjM7LFZuD9Uq44US-PTSB9tHblp43XabpK5suZKmuumFoumk8fRBcxHLbsp5KcwTD7nft4M-HsZgtJArjl8nFxEKZrWAI53gviNpYmbahpAbIhTcXytMYRWf_BEkw3RCVAcMLgCBgJvWOtw_A7_UzAFk-PLPJv3EzgB9YCTmu-Qvd_e9xZoikrIlfW80BT2gouRq-Wp_aFiC4fJqw00u4gRY6iQ',
            'https://lh3.googleusercontent.com/aida-public/AB6AXuC0OJPPZvby9Rs3wZLjXjRHKGmsyHxoEuOR-9C6pwez-zJJRmQT3uQIt8PcPX3xM17F8dvjYiiox4M98LEFfEFd9SiTVPXUtfWuCDRI-Yj5xeoJAIL3Qg4sKmqDFL6EStdww3uxlGBVPInWhS_8r29fedss1LLF1_yo4RyV_1sLvmjNXTKQl2eB2DN_-KNCOPGzsTtWMEXL-rSMBkxHP-Bv6L0Olciphr0viR4ympLKZYlfgOXcwtC0GjLXqXl6jpkG7HdEiPN2cOul',
        ];

        foreach ($images as $i => $url) {
            Gallery::create([
                'image_url' => $url,
                'caption' => 'Momen SMK Merdeka ' . ($i + 1),
            ]);
        }
    }
}
