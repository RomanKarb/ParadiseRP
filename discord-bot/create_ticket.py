# -*- coding: utf-8 -*-

import discord
from discord.ext import commands

intents = discord.Intents.default()
intents.messages = True
intents.reactions = True

bot = commands.Bot(command_prefix='!', intents=intents)

@bot.event
async def on_ready():
    guild_id = 1123971136611422210
    channel_id = 1126055550157852752
    guild = bot.get_guild(guild_id)
    channel = guild.get_channel(channel_id)
    
    message = await channel.send('Если вы хотите подать жалобу на игрока, вы можете создать тикет, нажав на реакцию ✅ ниже. Пожалуйста, будьте максимально подробными и предоставьте все необходимые доказательства и информацию для рассмотрения жалобы. Спасибо, что помогаете нам поддерживать порядок и безопасность на сервере!')
    await message.add_reaction('✅')  # Реакция :heart:

bot.run('MTEyNTgwMTY1MTQ1OTA3MjExMA.GXGgbR.HP2hbrx7VhC1ZcmjmYD8OTohPoXPzW_oxjFEdk')