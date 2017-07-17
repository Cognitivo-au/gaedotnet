using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using GoogleCloudAspNetCore.testapp.Models;
using System.ComponentModel.DataAnnotations;
using System.Net;



namespace GoogleCloudAspNetCore_testapp.Controllers
{
    public class HomeController : Controller
    {
        public IActionResult Index()
        {
            return View();
        }

        public IActionResult About()
        {
            ViewData["Message"] = "Your application description page.";

            return View();
        }

        public IActionResult Skills()
        {
            ViewData["Message"] = "Your skills description page.";

            return View();
        }

        public IActionResult team()
        {
            ViewData["Message"] = "Your team description page.";

            return View();
        }
    

        public IActionResult Error()
        {
            return View();
        }

        public IActionResult Success()
        {
            return View();
        }


        public IActionResult Contact()
        {
            return View();
        }
        public IActionResult Resources()
        {
            return View();
        }
    }
}
