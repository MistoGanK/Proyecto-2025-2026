<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/header.php'); ?>

<section class="flex flex-col items-center justify-center p-12 min-h-screen h-fit bg-[#F8F9FA]">
    
    <div class="w-full max-w-2xl h-fit bg-white shadow-2xl rounded-[2.5rem]  border border-gray-100">
        
        <div class="bg-[#0A090C] p-12 flex flex-col items-center justify-center relative">
            <div class="w-14 h-14 bg-white/10 rounded-full flex items-center justify-center border border-white/20 mb-4 backdrop-blur-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
            <h1 class="text-3xl font-black tracking-tighter text-white italic uppercase">
                Customer <span class="text-gray-400 not-italic font-light">Onboarding</span>
            </h1>
        </div>

        <form class="p-10 flex flex-col gap-10" action="/student022/backend/forms/db/customer/db_customer_insert.php" method="post">

            <div>
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-6 border-b border-gray-100 pb-2">Account Access</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <label class="flex flex-col gap-2">
                        <span class="text-[11px] font-black uppercase tracking-tight text-gray-900">Customer Username</span>
                        <input class="p-4 bg-[#F3F4F6] border-none rounded-2xl focus:ring-2 focus:ring-black outline-none transition-all font-medium text-gray-600 placeholder-gray-300" 
                            type="text" name="customer_username" placeholder="e.g. jsmith_tech">
                    </label>
                    <label class="flex flex-col gap-2">
                        <span class="text-[11px] font-black uppercase tracking-tight text-gray-900">Security Password</span>
                        <input class="p-4 bg-[#F3F4F6] border-none rounded-2xl focus:ring-2 focus:ring-black outline-none transition-all font-medium text-gray-600" 
                            type="password" name="customer_user_password" placeholder="••••••••">
                    </label>
                </div>
            </div>

            <div>
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-6 border-b border-gray-100 pb-2">Identity & Contact</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <label class="flex flex-col gap-2">
                        <span class="text-[11px] font-black uppercase tracking-tight text-gray-900">Identity Doc (DNI)</span>
                        <input class="p-4 bg-[#F3F4F6] border-none rounded-2xl focus:ring-2 focus:ring-black outline-none transition-all font-medium text-gray-600" 
                            type="text" name="customer_dni" placeholder="00000000X">
                    </label>
                    <label class="flex flex-col gap-2">
                        <span class="text-[11px] font-black uppercase tracking-tight text-gray-900">Email Address</span>
                        <input class="p-4 bg-[#F3F4F6] border-none rounded-2xl focus:ring-2 focus:ring-black outline-none transition-all font-medium text-gray-600" 
                            type="email" name="customer_email" placeholder="user@domain.com">
                    </label>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <label class="flex flex-col gap-2">
                        <span class="text-[11px] font-black uppercase tracking-tight text-gray-900">Forename</span>
                        <input class="p-4 bg-[#F3F4F6] border-none rounded-2xl focus:ring-2 focus:ring-black outline-none transition-all font-medium text-gray-600" 
                            type="text" name="customer_forename">
                    </label>
                    <label class="flex flex-col gap-2">
                        <span class="text-[11px] font-black uppercase tracking-tight text-gray-900">Surname</span>
                        <input class="p-4 bg-[#F3F4F6] border-none rounded-2xl focus:ring-2 focus:ring-black outline-none transition-all font-medium text-gray-600" 
                            type="text" name="customer_surname">
                    </label>
                </div>
            </div>

            <div>
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-6 border-b border-gray-100 pb-2">System Metadata</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <label class="flex flex-col gap-2">
                        <span class="text-[11px] font-black uppercase tracking-tight text-gray-900">Birth Date</span>
                        <input class="p-4 bg-[#F3F4F6] border-none rounded-2xl focus:ring-2 focus:ring-black outline-none transition-all font-medium text-gray-600" 
                            type="date" name="customer_birth_date">
                    </label>
                    <label class="flex flex-col gap-2">
                        <span class="text-[11px] font-black uppercase tracking-tight text-gray-900">Registered?</span>
                        <input class="p-4 bg-[#F3F4F6] border-none rounded-2xl focus:ring-2 focus:ring-black outline-none transition-all font-bold text-center" 
                            type="number" name="customer_registered" value="1" min="0" max="1">
                    </label>
                    <label class="flex flex-col gap-2">
                        <span class="text-[11px] font-black uppercase tracking-tight text-gray-900">Active?</span>
                        <input class="p-4 bg-[#F3F4F6] border-none rounded-2xl focus:ring-2 focus:ring-black outline-none transition-all font-bold text-center" 
                            type="number" name="customer_active" value="1" min="0" max="1">
                    </label>
                </div>
            </div>

            <div class="pt-6">
                <button type="submit" name="send" class="w-full p-5 bg-[#0A090C] text-white rounded-2xl font-black uppercase tracking-[0.2em] text-xs hover:bg-gray-800 transition-all shadow-xl active:scale-[0.98]">
                    Finalize Registration
                </button>
            </div>
            
        </form>
    </div>
</section>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/student022/backend/footer.php'); ?>